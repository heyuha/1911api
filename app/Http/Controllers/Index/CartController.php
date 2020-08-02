<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\GoodsModel;



class CartController extends Controller
{
    //购物车
    public function cart(){

    }
    //商品详情
    public function detail($goods_id){
        //根据商品id查询goods表
        $goodsinfo = GoodsModel::where('goods_id',$goods_id)->first();
        return view("index.");
    }
}
