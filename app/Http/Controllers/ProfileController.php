<?php

namespace App\Http\Controllers;

use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('users.profile')->with('user', $user);
    }
}
