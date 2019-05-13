<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;
use Symfony\Contracts\HttpClient;
class TestController extends Controller
{
    public function reg()
    {
        return view('test');
    }

    public function add(Request $request)
    {
        $pass1 = $request->input('pass1');
        $pass2 = $request->input('pass2');
        $email = $request->input('email');
        $e = UserModel::where(['email' => $email])->first();
        if ($e) {
            $response = [
                'errno' => 50004,
                'msg' => '邮箱已存在'
            ];
            die(json_encode($response, JSON_UNESCAPED_UNICODE));
        }

        $pass = password_hash($pass2, PASSWORD_BCRYPT);
        if ($pass1 != $pass2) {
            $response = [
                'errno' => 50002,
                'msg' => '密码不一致'
            ];
            die(json_encode($response, JSON_UNESCAPED_UNICODE));
        }
        $data = [
            'name' => $request->input('username'),
            'email' => $email,
            'pass' => $pass
        ];
        $str = json_encode($data);
        // storage_path('key/ras_private.pem');
        $k = openssl_pkey_get_private('file://' . storage_path('key/rsa_private.pem'));
        // var_dump($k);
        $sl = openssl_private_encrypt($str, $finaltext, $k, OPENSSL_PKCS1_PADDING);
        //echo "String crypted: $finaltext";exit;
        $pos_st = base64_encode($finaltext);
        $url = 'http://api.1809a.com/open';

        //创建一个新curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $pos_st);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type:text/plain'
        ]);
        $res = curl_exec($ch);
        $code = curl_errno($ch);
        var_dump($code);
        curl_close($ch);


    }

    public function loginadd()
    {
        return view('login');
    }

    public function login(Request $request)
    {

        $data = [
            'email'=>$request->input('email'),
            'pass'=>$request->input('pass')
        ];
        $str = json_encode($data);
        // storage_path('key/ras_private.pem');
        $k = openssl_pkey_get_private('file://' . storage_path('key/rsa_private.pem'));
        // var_dump($k);
        $sl = openssl_private_encrypt($str, $finaltext, $k, OPENSSL_PKCS1_PADDING);
        //echo "String crypted: $finaltext";exit;
        $pos_st = base64_encode($finaltext);
        $url = 'http://api.1809a.com/login';

        //创建一个新curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $pos_st);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type:text/plain'
        ]);
        $res = curl_exec($ch);
        $code = curl_errno($ch);
        var_dump($code);
        curl_close($ch);
    }
}
