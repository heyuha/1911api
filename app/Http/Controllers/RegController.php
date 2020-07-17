<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reg;

class RegController extends Controller
{
	//注册页面
    public function reg(){
    	return view("reg.index");
    } 


    //执行注册
    public function regadd(){
    	$post = request()->except("_token");
        
    	$res = Reg::create($post);
    	if($res){
    		return redirect("/user/login");
    	}
    }
}
