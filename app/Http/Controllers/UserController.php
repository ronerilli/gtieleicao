<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function create(){
        return view('user.create');
    }

    public function store(Request $request)
    {
    // Validate the form data
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'telefone' => 'max:255|email|unique:users',
        'email' => 'max:255|email|unique:users',
        'matricula' => 'max:100',
        'password' => 'max:255',
        'profile' => 'required',
        'eleicao_id' => 'int',
        'votou'=> 'int'
    ],[
        'name.required' => 'Nome é obrigatório',
        'email.email' => 'E-mail inválido',
        'email.unique' => 'E-mail já existe',
        'profile.required' => 'Perfil é obrigatório',
    ]);
        if ($validatedData['password'] = ''){
            $validatedData['password'] = Str::random(18);
        }
        // Encrypt the password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create a new user
        $user = User::create($validatedData);

        // Redirect to the home page with success message
        return redirect('/home')->with('success', 'Usuário cadastrado com sucesso!');

}
  }
