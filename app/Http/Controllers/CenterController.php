<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reg;

class CenterController extends Controller
{
    public function center(){
    	$res = Reg::get();
    	return view("center.index",['reg'=>$res]);
    }
}
