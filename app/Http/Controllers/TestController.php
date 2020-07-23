<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    public function hello(){
    	echo "hello world";
    }

    //获取access_token 
    public function wxgettoken(){
    	$appid = "wxc995cb21dadc2fd8";
    	$appsecret = "c59aca85f61188b80cf5f824f0b6b6a8";
    	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
    	$cont = file_get_contents($url);
    	$content = json_decode($cont,true);
    	print_r($content['access_token']);

    }
    public function wxgettoken2(){
    	$appid = "wxc995cb21dadc2fd8";
    	$appsecret = "c59aca85f61188b80cf5f824f0b6b6a8";
    	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
    	// 创建一个新cURL资源
		$ch = curl_init();

		// 设置URL和相应的选项
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		// curl_setopt($ch, CURLOPT_, value)
		// 抓取URL并把它传递给浏览器
		$response = curl_exec($ch);

		// 关闭cURL资源，并且释放系统资源
		curl_close($ch);
    }
    public function wxgettoken3(){
    	$appid = "wxc995cb21dadc2fd8";
    	$appsecret = "c59aca85f61188b80cf5f824f0b6b6a8";
    	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
    	$client = new Client();
        $response = $client->request('GET',$url);
        $data = $response->getBody();
        echo $data;
    }

    public function getaccesstoken(){
        $token = Str::random(32);
        $data = [
            'token'=>$token,
            'expire_in'=> 7200
        ];

        echo json_encode($data);
    }


    //获取用户信息
    public function userinfo(){
        echo "userinfo";
    }

    //测试2
    public function test2(){
        $url = "http://www.1911.com/test2";
        $response = file_get_contents($url);
        echo $response;
    }


    //联系hash
    public  function hash1(){
        $data = [
            'name' => 'heyuhao',
            'email' => 'ranhaogg@qq.com',
            'age'  => '18'
        ];
        $hash_info = "hash_info";
        Redis::hmset($hash_info,$data);
    }
    public function hash2(){
        $res = "hash_info";
        $data = Redis::hgetall($res);
        print_r($data);
    }

    //测试
    public function goodsstore(){


    }
    public function goodsadd(){
        $key = "goods_store";
        Redis::lpop($key);
        $len = Redis::llen($key);
        if($len<=0){
            $data=[
                'erron' => "00001",
                'msg' => '库存不足'
            ];
            return $data;
        }else{
            $data=[
                'erron' => '00002',
                'msg' => 'ok'
            ];
            return $data;

        }
    }


}
