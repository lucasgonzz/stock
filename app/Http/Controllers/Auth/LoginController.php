<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{

    public function __construct() {
        $this->middleware('guest', ['only' => 'showLoginForm']);
    }

    public function showLoginForm() {
        return view('auth.login');
    }
    public function login() {
        $credentials = $this->validate(request(), [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);

        if(Auth::attempt($credentials)){
            return redirect('/');
        }
        return redirect('login')->with('errorLogin', 'Datos incorrectos, verifique sus datos por favor');
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }

    public function username() {
        return 'name';
    }
}
