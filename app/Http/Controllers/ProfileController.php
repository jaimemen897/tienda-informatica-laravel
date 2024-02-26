<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('users.profile')->with('user', $user);
    }

    public function edit($id)
    {
        $user = Auth::user();
        if ($user) {
            return view('users.edit')->with('user', $user);
        } else {
            flash('Usuario no encontrado')->error();
            return redirect()->route('users.profile');
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            flash('Usuario actualizado correctamente')->success();
            return redirect()->route('users.profile');
        } else {
            flash('Usuario no encontrado')->error();
            return redirect()->route('users.profile');
        }
    }
}
