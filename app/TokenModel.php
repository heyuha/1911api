<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TokenModel extends Model
{
    // //// 指定表明
    protected $table="u_token";
    // 指定主键id
    protected $primaryKey="id";
    // 关闭时间chuo1
    public $timestamps = false;
    // 黑名单
    protected $guarded = [];
}
