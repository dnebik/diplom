<?php
namespace App\Http\Controllers;

use App\Providers\MyConst;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class AuthController
{
    public function index() {
        if (Auth::user()) return response(User::getUser());
        else return response(['status' => MyConst::UNAUTHORIZED]);
    }

    public function login(Request $request) {

        if (!$request->has('login') || !$request->has('password') || !$request->has('remember'))
            return response(['status' => MyConst::BAD_REQUEST]);

        $user = User::where([
            'login' => $request->post('login'),
            'password' => md5($request->post('password'))
        ])->first();

        if (!is_null($user)){
            if ($user->status == '0') {
                return response(['status' => MyConst::USER_BLOCKED]);
            }
            Auth::login($user, $request->post('remember'));
            return response(['status' => MyConst::OK, 'user' => User::getUser()]);
        }
        else return response(['status' => MyConst::UNAUTHORIZED]);
    }

    public function logout() {
        Auth::logout();
        return response(['status' => MyConst::OK]);
    }
}
