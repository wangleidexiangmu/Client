<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Client;
class AddController extends Controller
{
    public function add(){
        $content = "123";
         $this->encode($content);

    }


    function encode($string = '', $skey = 'wenzi')
    {

        $strArr = str_split(base64_encode($string));

        $strCount = count($strArr);

        foreach (str_split($skey) as $key => $value)

            $key < $strCount && $strArr[$key] .= $value;

        return str_replace(array('=', '+', '/'), array('O0O0O', 'o000o', 'oo00o'), join('', $strArr));

    }
    public function testapp(){
        $url ='http://api.1809a.com/open';
        $post_str =$this->add();
        //echo $post_str;exit;
        //创建一个新curl
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$post_str);
        curl_setopt($ch,CURLOPT_HTTPHEADER,[
            'Content-Type:text/plain'
        ]);
        $res=curl_exec($ch);
        $code=curl_errno($ch);
        var_dump($code);
        curl_close($ch);
    }
}
