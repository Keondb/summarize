<?php

namespace app\lib\exception;

use think\Exception;

class Parameter extends Exception{
    public $httpStatus = 201;
    public $errorCode = 100001;
    public $msg = '参数错误';
 
}