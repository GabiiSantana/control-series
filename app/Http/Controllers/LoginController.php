<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController {
    public function index() {
        return view('login.index');
    }

    public function store(Request $request) {
        // Espera por parâmetro credenciais
        if(!Auth::attempt($request->only(['email', 'password']))){
            return redirect()->back()->withErrors('Usuário ou senha inválidos');
        } 

        $request->session()->regenerate();
        return redirect()->route('series.index');
    }
    public function destroy( ){
        Auth::logout();
        return to_route('login');
    }
}