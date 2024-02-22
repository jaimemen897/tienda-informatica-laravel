<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ChangePasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('auth.passwords.create_new_pass');
    }

    /*cambiar contraseña de usuario*/
    public function changePassword()
    {
        $email = request('email');
        $password = request('password');
        $password_confirmation = request('password_confirmation');
        $user = DB::table('clients')->where('email', $email)->first();
        if ($password == $password_confirmation) {
            DB::table('clients')->where('email', $email)->update(['password' => bcrypt($password)]);
            return redirect('login');
        } else {
            return redirect('password/reset');
        }
    }
}
