<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\GoodsModel;
use App\CartModel;
//use App\GoodsModel;


class CartController extends Controller
{
    //购物车列表
    public function carts(){


        $goods_id = $_GET['goods_id'];
        $goodsinfo = GoodsModel::where('goods_id',$goods_id)->first();

        return view("index.cart.cart",['goodsinfo'=>$goodsinfo]);

    }
    //商品详情
    public function detail($goods_id){
        //根据商品id查询goods表
        $goodsinfo = GoodsModel::where('goods_id',$goods_id)->first();
        return view("index.detail.detail",['goodsinfo'=>$goodsinfo]);
    }
}
