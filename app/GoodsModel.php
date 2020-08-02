<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodsModel extends Model
{
    ////// 指定表明
    protected $table="p_goods";
    // 指定主键id
    protected $primaryKey="goods_id";

    public $timestamps = false;
    // 黑名单
    protected $guarded = [];
}
