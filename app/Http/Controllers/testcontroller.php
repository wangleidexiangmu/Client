<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testcontroller extends Controller
{

    public function jm(){
        $pass=$this->add('abc');
        echo $pass;
    }
   public function add($key,$n=1){
        $pass='';
       $lenth=strlen($key);
       for($i=0;$i<$lenth;$i++){
           $add=ord($key[$i])+$n;
           $pass=chr($add);

       }
       return $pass;
   }
   public function pass(){
        $data='hello';
        $method='AES-256-CBC';
        $key='wanglei';

        $option=OPENSSL_RAW_DATA;
        $iv='1234567890qwerty';
        $enc_str=openssl_encrypt($data,$method,$key,$option,$iv);
     $admin= base64_encode($enc_str);
     // echo $admin;
       $url ='http://api.1809a.com/twoadd';

       //创建一个新curl
       $ch=curl_init();
       curl_setopt($ch,CURLOPT_URL,$url);
       curl_setopt($ch,CURLOPT_POST,1);
       curl_setopt($ch,CURLOPT_POSTFIELDS,$admin);
       curl_setopt($ch,CURLOPT_HTTPHEADER,[
           'Content-Type:text/plain'
       ]);
       $res=curl_exec($ch);
       //$code=curl_errno($ch);
      // var_dump($code);
       curl_close($ch);
   }
   public function open(){
        $mi='kR59WbzQbcWM9399fYj6iQ==';
        $data=base64_decode($mi);
       $method='AES-256-CBC';
       $key='wanglei';

       $option=OPENSSL_RAW_DATA;
       $iv='1234567890qwerty';
       $enc_str=openssl_decrypt($data,$method,$key,$option,$iv);
        echo $enc_str;

   }
   public function admin(){
        $data=[
            'name'=>'zhangsan',
            'age'=>18,
        ];
        $str=json_encode($data);
       //storage_path('key/ras_private.pem');
      $k=openssl_pkey_get_private('file://'.storage_path('key/rsa_private.pem'));
       // var_dump($k);
       $sl=openssl_private_encrypt($str,$finaltext,$k,OPENSSL_PKCS1_PADDING);
       //echo "String crypted: $finaltext";exit;
       $pos_st=base64_encode($finaltext);
       $url ='http://api.1809a.com/open';

       //创建一个新curl
       $ch=curl_init();
       curl_setopt($ch,CURLOPT_URL,$url);
       curl_setopt($ch,CURLOPT_POST,1);
       curl_setopt($ch,CURLOPT_POSTFIELDS,$pos_st);
       curl_setopt($ch,CURLOPT_HTTPHEADER,[
           'Content-Type:text/plain'
       ]);
       $res=curl_exec($ch);
       $code=curl_errno($ch);
       var_dump($code);
       curl_close($ch);
   }
   public function qian(){
        $data=[
            'name'=>'lisi',
            'age'=>20,
            'sex'=>'男'
        ];
       $str=json_encode($data);
       storage_path('key/ras_private.prm');
       $k=openssl_pkey_get_private('file://'.storage_path('key/rsa_private.pem'));
       // var_dump($k);
       $sl=openssl_sign($str,$finaltext,$k);
       //echo "String crypted: $finaltext";exit;
       $pos_st=base64_encode($finaltext);
      // echo $pos_st;
       $url ='http://api.1809a.com/sign?sign='.urlencode($pos_st);
        //echo $url;
       //创建一个新curl
       $ch=curl_init();
       curl_setopt($ch,CURLOPT_URL,$url);
       curl_setopt($ch,CURLOPT_POST,1);
       curl_setopt($ch,CURLOPT_POSTFIELDS,$str);
       curl_setopt($ch,CURLOPT_HTTPHEADER,[
           'Content-Type:text/plain'
       ]);
       $res=curl_exec($ch);
       $code=curl_errno($ch);
      // var_dump($code);
       curl_close($ch);

   }
}
