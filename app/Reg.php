<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reg extends Model
{
    //// 指定表明
    protected $table="reg";
    // 指定主键id
    protected $primarKey="reg_id";
    // 关闭时间chuo1
    public $timestamps = false;
    // 黑名单
    protected $guarded = [];
}
