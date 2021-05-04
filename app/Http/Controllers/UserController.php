<?php


namespace App\Http\Controllers;


use App\MyConst;
use App\User;

class UserController extends Controller
{
    public function getAllStaff() {
        $staff = User::where(['status' => 1])->get();
        return response()->json(['status' => MyConst::OK, 'staff' => $staff]);
    }
}
