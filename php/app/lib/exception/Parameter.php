<?php

namespace app\lib\exception;


class Parameter extends BaseException{
    public $httpStatus = 201;
    public $errorCode = 100001;
    public $msg = '参数错误';


}