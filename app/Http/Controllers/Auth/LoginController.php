<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('client')->attempt($credentials)) {
            Auth::setDefaultDriver('client');
            return redirect()->intended('/products');
        }

        if (Auth::guard('employee')->attempt($credentials)) {
            Auth::setDefaultDriver('employee');
            return redirect()->intended('/products');
        }

        return redirect()->back()->withErrors([
            'login' => 'Las credenciales proporcionadas no son correctas.',
        ]);
    }

    protected function guard()
    {
        if (request()->is('client/*')) {
            return Auth::guard('client');
        } if (request()->is('employee/*')) {
            return Auth::guard('employee');
        } else {
            return Auth::guard();
        }
    }
}
