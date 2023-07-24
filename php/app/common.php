<?php
// 应用公共文件

// 公共json 返回格式
function sucess($data = [],$msg = '操作成功'){
  return show($msg,200,10000,$data);
}


// 公共json 返回格式
function show($msg,$httpStatus = 200,$code = 10000,$data = []){
    $result = [
        'code' => $code,
        'msg'=>$msg,
        'data'=>$data,
    ];
    return json($result,$httpStatus);
}

// 生成随机字符串
function getRandChar($length) {
    $str = null;
    $strPol = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghjklqwe';
    $max = strlen($strPol)-1;

    for($i = 0; $i < $length; $i++){
        $str .= $strPol[rand(0,$max)];
    }
    
    return $str;
}


// 获取用户真实 IP 地址
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
  }
   