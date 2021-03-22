<?php


namespace App\Http\Controllers;


use App\User;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function index() {
        if (Auth::user()) return response('Authorized');
        else return response('Unauthorized', 401);
    }

    public function login(Request $request) {

        $user = User::where([
            'login' => $request['login'],
            'password' => md5($request['password'])
        ])->first();

        if (Auth::attempt($user, $request['remember'])) return response('ok');
        else return response('not ok', 401);
    }

    public function logout() {
        Auth::logout();
    }
}
