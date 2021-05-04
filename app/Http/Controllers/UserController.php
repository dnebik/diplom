<?php


namespace App\Http\Controllers;


use App\User;

class UserController extends Controller
{
    public function getAllStaff() {
        return response()->json(User::where('status', '=', 1)->all());
    }
}
