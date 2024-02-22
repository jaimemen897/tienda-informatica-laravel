<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\TokenController;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Validator;


class ResetPasswordController extends Controller
{

    use ResetsPasswords;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail()
    {
        $tokenController = new TokenController();
        $email = request('email');
        $token = $tokenController->getToken();

        $emailController = new EmailController($email, $token);
        $emailController->sendRestoreEmail();

        $tokenController->showTokenForm();
        return redirect('token/verify');
    }
}
