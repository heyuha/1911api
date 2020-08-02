<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //登录
    public function login(){
        return view("index.login.login");
    }
    //注册
    public function reg(){
        return view("index.login.reg");
    }
}
