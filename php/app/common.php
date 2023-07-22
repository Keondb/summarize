<?php
// 应用公共文件


// 公共json 返回格式
function show($msg,$httpStatus = 200,$code = 10000,$data = []){
    $result = [
        'code' => $code,
        'msg'=>$msg,
        'data'=>$data,
    ];
    return json($result,$httpStatus);
}