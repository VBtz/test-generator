<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {

    public function index() {
        return view('auth');
    }

    public function login(Request $request) {
        $credentials = $request->only('login', 'password');

        if (Auth::attempt($credentials, $request->remember != null)) {
            return redirect()->intended('panel');
        }

        return back()->withInput()->withErrors([
           'auth_fail' => 'Неверный логин или пароль'
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
