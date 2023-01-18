<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        'email' => 'required|max:255|email|unique:users',
        'password' => 'required|confirmed|min:6',
        'profile' => 'required'
    ],[
        'name.required' => 'Nome é obrigatório',
        'email.required' => 'E-mail é obrigatório',
        'email.email' => 'E-mail inválido',
        'email.unique' => 'E-mail já existe',
        'password.required' => 'Senha é obrigatória',
        'password.confirmed' => 'Senhas não conferem',
        'password.min' => 'Senha deve ter no mínimo 6 caracteres',
        'profile.required' => 'Perfil é obrigatório',
    ]);

        // Encrypt the password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create a new user
        $user = User::create($validatedData);

        // Redirect to the home page with success message
        return redirect('/home')->with('success', 'Usuário cadastrado com sucesso!');

}
  }
