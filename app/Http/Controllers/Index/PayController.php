<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PayController extends Controller
{
    //支付宝支付
    public function pay(Request $request){
        $oid = $request->get("oid");

        //请求参数
        $param2 = [
            'out_trade_no' => time().rand(11111,99999),
            'product_code' => 'FAST_INSTANT_TRADE_PAY',
            'total_amount' => '1100000000000',
            'subject' => '1911-测试订单-'.Str::random(16)
        ];

        //公共参数
        $param1 = [
            'app_id' => '2016102300743782',
            'method' => 'alipay.trade.page.pay',
            'return_url' => 'http://1911heyuhao.heyuhao.icu/alipay/return',
            'charset' => 'utf-8',
            'sign_type' => 'RSA2',
            'timestamp' => date('Y-m-d H:i:s'),
            'version' => '1.0',
            'notify_url' => 'http://1911heyuhao.heyuhao.icu/alipay/notify',
            'biz_content' => json_encode($param2),
        ];
       //根据首字母进行排序
        ksort($param1);
//        声明一个空的字符串 为下面循环拼接
        $str = "";
//        循环拼接
        foreach($param1 as $k=>$v){
            $str.= $k . '=' . $v ."&";
        }
        //处理右边多余的&
        $str = rtrim($str,'&');

        $sign = $this->sign($str);

        $url = "https://openapi.alipaydev.com/gateway.do?".$str."&sign=".urlencode($sign);
        return redirect($url);
    }

    protected function sign($data)

    {
        $priKey = file_get_contents(storage_path('keys/ali_priv.key'));
        $res = openssl_get_privatekey($priKey);
        var_dump($res);echo '<hr>';
        ($res) or die('您使用的私钥格式错误，请检查RSA私钥配置');
        openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);
        openssl_free_key($res);
        $sign = base64_encode($sign);
        return $sign;
    }

}
