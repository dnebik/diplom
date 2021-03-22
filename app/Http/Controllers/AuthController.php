<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController
{
    public function index() {
        if (Auth::user()) return response($this->getUser());
        else return response('Unauthorized', 401);
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function getUser() {
        $user = Auth::user();
        unset($user['id']);
        unset($user['login']);
        unset($user['password']);
        unset($user['unit']);
        unset($user['status']);
        unset($user['remember_token']);
        return $user;
    }

    public function login(Request $request) {

        if (!$request->has('login') || !$request->has('password') || !$request->has('remember'))
            return response('Bad request', 400);

        $user = User::where([
            'login' => $request->post('login'),
            'password' => md5($request->post('password'))
        ])->first();

        if (!is_null($user)){
            Auth::login($user, $request->post('remember'));
            return response($this->getUser());
        }
        else return response('Unauthorized', 401);
    }

    public function logout() {
        Auth::logout();
        return response('ok');
    }
}
