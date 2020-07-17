<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reg;

class RegController extends Controller
{
	
    public function reg(Request $request){
        $user_name = $request->post("user_name");
        $user_email = $request->post("user_email");
        $pass = $request->post("pass1");
        $pass2 = $request->post("pass2");

        $password = password_hash($pass,PASSWORD_BCRYPT);

        $user_info = [

        ];

    }
}
