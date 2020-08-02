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





    public function enc1(){

        $data = "Hello Wored";

        $mehod = "AES-256-CBC";

        $key = "1911api";

        $iv ="aaaabbbbccccdddd";

        $env_data = openssl_encrypt($data,$mehod,$key,OPENSSL_RAW_DATA ,$iv);

//        echo "加密玩数据：".$env_data;

        //转为bs64

        //          get方法

        $b64 = base64_encode($env_data);

        $url = "http://www.1911.com/test/dec";

//        $www = $url."?data=".urlencode($b64);

//        $response = file_get_contents($www);

//        echo $response;



//        post方法

        $client = new Client();

        $response = $client->request('POST',$url,[

            'form_params' => [

                'data' => $b64

            ]

        ]);

        echo $response->getBody();

    }





    public function enc2(){

        $data = "你好";

        $content = file_get_contents(storage_path('keys/www/pub.key'));

        $puy_key = openssl_get_publickey($content);

        openssl_public_encrypt($data,$enc_data,$puy_key);

        $b64 = base64_encode($enc_data);

        $url = "http://www.1911.com/test/dec2";

        $client = new Client();

        $response = $client->request('POST',$url,[

            'form_params' => [

                'data' => $b64

            ]

        ]);

        echo $response->getBody();

        $api_b64 = $response->getBody();

        $api_data = base64_decode($api_b64);



        //api私钥

        $a_prev_key = file_get_contents(storage_path('keys/api/prev.key'));

        $api_prev_key = openssl_get_privatekey($a_prev_key);

        openssl_private_decrypt($api_data,$api_dec_data,$api_prev_key);

        echo $api_dec_data;





    }

    //验签

    public function sign(){

        $key = "1911api";

        $data = "Hello World";

        $sign_str = md5( $data . $key );

        $url = "http://www.1911.com/test/sign?data=".$data."&sign=".$sign_str;

        $response = file_get_contents($url);

        echo $response;

    }



    public function sign2(){

        $data = "Hello World";

        $priv_key = file_get_contents(storage_path('/keys/api/prev.key'));

//        $priv_key_id = openssl_get_privatekey($priv_key);

        openssl_sign($data,$prev_sign,$priv_key,OPENSSL_ALGO_SHA1);

        $b64 = base64_encode($prev_sign);

        $b64=urlencode($b64);

        $url = "http://www.1911.com/test/sign2?data=".$data.'&sign='.$b64;

        $response = file_get_contents($url);

        echo  $response;

    }


    public function header1(){
        $uid = "123456";
        $token = Str::random(16);
        $url = "http://www.1911.com/test/header1";
        $headers = [
            'uid:'.$uid,
            'token:'.$token,
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        curl_exec($ch);
        curl_close($ch);
    }



    //登录GitHub
    public function github(){
        $code = $_GET['code'];
        $response = $this->access_token($code);


        $response = json_decode($response,true);

        dd($response);
    }
    //获取GitHubaccess_token
    public function access_token($code){
        $client_id = "a31c24bbf92b6c851c30";
        $client_secret = "7ccdac10114b070b0fc840edf45f8284c37ea9d3";
//        //获取access_token地址
        $url = "https://github.com/login/oauth/access_token";

        $client = new Client();

        $response = $client->request("POST",$url,[
            'form_params' => [
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'code' => $code,
            ],
        ]);
//        获取token以后获取用户信息
        $access_token =  $response->getBody();
        //        $url = "https://github.com/login/oauth/access_token?code=".$code."&client_id=".$client_id."&client_secret=".$client_secret;
//        $access_token = file_get_contents($url);
//        $arr =  json_encode($access_token);
//        dd($arr);



//        $url = "https://github.com/login/oauth/access_token?code=".$code."&client_id=".$client_id."&client_secret=".$client_secret;
//        $access_token = file_get_contents($url);
        $arr = explode("&",$access_token);
//        echo 111;
//        print_r($arr) ;
        $arr1  =$arr[0];
        $arr3 = substr($arr1,13);
//        echo $arr3;die;
        $res = $this->githubuserinfo($arr3);

        return $res;
    }
    //获取用户信息
    public function githubuserinfo($access_token){
        //echo $access_token;die;
        $url = "https://api.github.com/user";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_HTTPHEADER,array('Authorization: token '.$access_token,'User-Agent:http://developer.github.com/v3/#user-agent-required'));
        $response = curl_exec($ch);
//        dd($response);
        if(curl_errno($ch)!=0){
            echo curl_errno($ch);
            echo curl_error($ch);
            die;
        }
        curl_close($ch);
        return $response;

    }

}