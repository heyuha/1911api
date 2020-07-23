<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\GoodsModel;
use Illuminate\Support\Facades\Redis;


class GoodsController extends Controller
{
    // //

    public function goods(){
        $goods_id  = request()->get("id");

        if($goods_id){
            echo 123;
        }else{
            $key = "h:goods_info:".$goods_id;

            //判断缓存是否存在
            $goods_info = Redis::hgetAll($key);

            if(empty($goods_info)){

                $g = GoodsModel::select('goods_id','goods_sn','cat_id','goods_name')->where("goods_id",$goods_id)->first();
                //缓存到redis

                $goods_info = $g->toArray();
                Redis::hMset($key,$goods_info);
                echo "无缓存";
            }else{
                echo "已缓存";
            }
            Redis::hincrby($key,"view_count",1);
        }

    }
}
