<?php

namespace App\Http\Controllers\Web\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function form()
    {
        return view('auth.auth-login');
    }

    public function register(RegisterRequest $request)
    {
        //
    }

    public function login(LoginRequest $request)
    {
        if (! Auth::attempt($request->validated())) {
            return back()->withErrors([
                'auth' => 'invalid credentials'
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
