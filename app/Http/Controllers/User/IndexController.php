<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Reg;
use App\TokenModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;
use App\GoodsModel;

class IndexController extends Controller
{
    //注册
    public function reg(Request $request){
        $user_name = $request->post("user_name");
        $user_email = $request->post("user_email");
        $pass = $request->post("pass1");
        $pass2 = $request->post("pass2");

        $password = password_hash($pass,PASSWORD_BCRYPT);

        //验证
        $user_names = Reg::where('user_name',$user_name)->first();
        if($user_names){
            $response = [
                 'erron' => 40003,
                 'msg' => '账号已存在'
            ];
            return $response;
        }
        if($pass!==$pass2){
            $response = [
                'erron' => 50002,
                'msg' => '两次输入密码不一致'
            ];
            return $response;
        }

        $user_info = [
            'user_name' => $user_name,
            'user_email' => $user_email,
            'password' => $password,
            'user_time' => time()
        ];
        $user_id = Reg::insertGetId($user_info);

        if($user_id){
            $response = [
                'erron' => 0,
                'msg' => 'ok'
            ];
            return $response;
        }

    }

        //登录
        public function login(Request $request){
            $user_name = $request->post("user_name");
            $password = $request->post('password');

            $u = Reg::where(['user_name'=>$user_name])->first();
            $user_id=$u['user_id'];
//            dd($user_id);
            if($u){
                //验证密码
                $pass = password_verify($password,$u->password);
                $token = Str::random(32);

                if($pass){
                    //账号密码正确  token存数据库   设置过期时间7200秒

                    $data = [
                        'token' => $token,
                        'expires_in' => time() + 7200,
                        'user_id' => $u->user_id
                    ];
                    $res = TokenModel::insertGetId($data);
                    if($res){
                        $key=":view:".$user_id;

                        $field=$_SERVER["REQUEST_URI"];
                        if(strpos($field,'?')){
                            $field1=strpos($field,'?');
                            $field2=substr($field,0,$field1);
                            Redis::hincrby($key,$field2,1);
                        }else{
                            Redis::hincrby($key,$field,1);
                        }
                        $response = [
                            'erron' => '0',
                            'msg' => 'ok',
                            'token' => $token
                        ];
                        return $response;


                    }else{
                        $response = [
                            'erron' => '60001',
                            'msg' => '登录失败 token存失败'
                        ];
                        return $response;
                    }
                }else{
                    //密码错误提示登录失败
                    $response = [
                        'erron' => '50003',
                        'msg' => '登录失败 密码错误'
                    ];
                    return $response;
                }
            }else{
                $response = [
                    'erron' => '50001',
                    'msg' => '登录失败 账号错误'
                ];
                return $response;
            }
        }

    //用户个人中心
    public function center(Request $request){
//
//        //拉黑  如果为true 则存在 已被拉黑给出提示
//          $key = "s:token_black";
//        $tokenblack=Redis::sismember($key,$token);
//
//        if($tokenblack){
//            $data = [
//                'erron' => 00004,
//                'msg' => '你已被拉黑'
//            ];
//            return $data;
//        }
//        //签到
//        $lahei_token = "ss:qiandao".date('ymd');
//
//
////        dd($token);
//
//        }
    }
  

}
