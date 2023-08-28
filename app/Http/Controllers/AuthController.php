<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\URL;
use App\Models\Eleitor;
use App\Http\Controllers\EleicaoController;

class AuthController extends Controller
{
    public function loginAdmin()
    {
        return view('login-administrador');
    }

    public function authenticateAdmin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/home');
        }
        else {
            return redirect()->intended('login-administrador')->with('error', 'E-mail ou senha inválidos');
        }
    }

    public function authenticateEleitor(Request $request)
    {
        // Obtenha o código SMS enviado para o telefone do eleitor
        $codigoSMS = $request->input('codigo_sms');
        $codigoarmazenado = $request->session()->get('codigo_sms');

        // Verifique se o código SMS é válido (pode ser implementado de acordo com a sua lógica)
        $codigoSMSValido = $codigoarmazenado == $codigoSMS; // Exemplo: considerando válido para fins de demonstração

        if ($codigoSMSValido) {
            $matricula = $request->session()->get('matricula');
        
            // Buscar o eleitor com base na matrícula
            $eleitor = Eleitor::where('matricula', $matricula)->first();
        
            if ($eleitor) {
                // Autenticar o eleitor
                Auth::loginUsingId($eleitor->id);
        
                return redirect()->route('exibir-eleicao', $eleitor->eleicao_id)->with('success', 'Autenticação realizada com sucesso.');
            } else {
                return redirect()->back()->with('error', 'Eleitor não encontrado.');
            }
            } else {
            return redirect()->back()->with('error', 'Código SMS inválido');
        }
    }

    public function enviarCodigoSMS(Request $request)
    {
        $matricula = $request->input('matricula');

        // Buscar o eleitor com base na matrícula
        $eleitor = Eleitor::where('matricula', $matricula)->first();

        if ($eleitor) {
            // Obter o telefone do eleitor
            $telefone = $eleitor->telefone;

            // Gerar um código SMS aleatório
            $codigoSMS = mt_rand(1000, 9999);
            error_log($codigoSMS);
            // Salvar o código SMS na sessão para validação posterior
            $request->session()->put('codigo_sms', $codigoSMS);
            $request->session()->put('matricula', $matricula);

            // Criar uma URL para o endpoint authenticateEleitor com o código SMS e a matrícula
            $url = URL::signedRoute('authenticate-eleitor', [
                'codigo_sms' => $codigoSMS,
                'matricula' => $matricula,
            ]);

            // Inicializar o cliente Twilio
            $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

            // Enviar o código SMS para o número de telefone do eleitor
            $message = $twilio->messages->create(
                $telefone,
                [
                    'from' => env('TWILIO_PHONE_NUMBER'),
                    'body' => 'Seu código de autenticação é: ' . $codigoSMS,
                ]
            );

            return redirect()->back()->with('success', 'Código SMS enviado com sucesso.');
        } else {
            return redirect()->back()->with('error', 'Matrícula não encontrada.');
        }
    }

    public function loginEleitor()
    {
        return view('login-eleitor');
    }

    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/');
        }
        return $next($request);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }


}
