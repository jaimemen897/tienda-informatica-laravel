<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
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

    public function logout(Request $request)
    {
        $cart = session('cart', []);
        foreach ($cart as $item) {
            $product = Product::find($item->product->id);
            if ($product === null) {
                continue;
            }
            $product->stock += $item->quantity;
            $product->save();
        }
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

    public function showClientLoginForm()
    {
        if (Auth::guard('web')->check()) {
            return redirect('/profile');
        }
        return view('auth.login', ['url' => 'client']);
    }
}
