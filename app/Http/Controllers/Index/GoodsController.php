<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    //列表
    public function goodsinfo(){
        return view("index.goods.goodsinfo");
    }
    
}
