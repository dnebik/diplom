<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function index() {
        if (Auth::user()) return response('Authorized');
        else return response('Unauthorized', 401);
    }

    public function login(Request $request) {

        if (!$request->has('login') || !$request->has('password') || !$request->has('remember'))
            return response('Bad request', 400);

        $user = User::where([
            'login' => $request->post('login'),
            'password' => md5($request->post('password'))
        ])->first();

//        return response($user, 400);

        if (!is_null($user)){
            Auth::login($user, $request->post('remember'));
            return response('ok');
        }
        else return response('not ok', 401);
    }

    public function logout() {
        Auth::logout();
    }
}
