<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
		// curl_setopt($ch, CURLOPT_, value)
		// 抓取URL并把它传递给浏览器
		curl_exec($ch);

		// 关闭cURL资源，并且释放系统资源
		curl_close($ch);
    }
    public function wxgettoken3(){
    	$appid = "wxc995cb21dadc2fd8";
    	$appsecret = "c59aca85f61188b80cf5f824f0b6b6a8";
    	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
    	
    }
}
