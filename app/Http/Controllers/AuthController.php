<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

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
        $credentials = $request->only('matricula');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/home');
        }
        else {
            print 'Matrícula ou senha inválidos';
            return redirect()->intended('login-administrador');
        }
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
