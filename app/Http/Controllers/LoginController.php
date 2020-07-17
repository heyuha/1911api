<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reg;

class LoginController extends Controller
{
    //
    public function login(){
    	return view("login.index");
    }
    public function loginadd(){
    	$post = request()->except("_token");
    	$reg = Reg::where('reg_name',$post['reg_name'])->first();
    	
    	if($reg->reg_pwd!=$post['reg_pwd']){
    		return redirect("user/login")->with('msg','用户名或密码不对！');
    	}
    	return redirect("user/center");
    	
    }
}
