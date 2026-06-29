<?php 
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController {
    public function create() {
    return view('users.create');
    }
    public function store(Request $request) {
        $data = $request->except('_token'); // Pegando todos os dados registrados pelo usuário
        $data['password'] = Hash::make($data['password']); // Faz uma hash na senha deixando-a mais segura. 

        $user = User::create($data); // criando o usuário no banco de dados
        Auth::login($user); // Autenticando usuário

        return to_route('series.index');
    }
}