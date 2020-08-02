<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\GoodsModel;

class GoodsController extends Controller
{
    //首页
    public function goods(){
        //最新的三条
        $menu=GoodsModel::orderby('goods_id','DESC')->limit(4)->get();
        $menu=GoodsModel::orderby('goods_id','DESC')->limit(4)->get();
        //最热
//        $is_new=GoodsModel::where('is_new','1')->orderBy('goods_id','DESC')->limit(6)->get();
//
//        $best=GoodsModel::where('is_best','1')->orderby('goods_id','DESC')->limit(6)->get();

        return view('index.goods.goods',['menu'=>$menu]);

    }
    //列表
    public function goodsinfo(){
        return view("index.goods.goodsinfo");
    }
    
}
