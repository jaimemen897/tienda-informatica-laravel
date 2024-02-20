<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function guard()
    {
        if(request()->is('client/*')) {
            return Auth::guard('client');
        } else if(request()->is('employee/*')) {
            return Auth::guard('employee');
        } else {
            return Auth::guard();
        }
    }
}
