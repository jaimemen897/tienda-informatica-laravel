<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokenController extends Controller
{
    private static $instance = null;
    protected $token;

    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new TokenController();
        }

        return self::$instance;
    }

    public function __construct()
    {
        $this->token = substr(md5(uniqid(rand(), true)), 0, 8);
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getToken()
    {
        return $this->token;
    }


    public function showTokenForm()
    {
        return view('auth.passwords.verify_token');
    }

    public function verifyToken(Request $request)
    {
        $token = $request->input('token');
        if (trim(strtolower($token)) == trim(strtolower($this->token))) {
            return redirect('password/change');
        } else {
            return response()->json($this->token);
        }
    }
}
