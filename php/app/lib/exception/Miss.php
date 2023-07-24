<?php

namespace app\lib\exception;


class Miss extends BaseException{
    public $httpStatus = 405;
    public $errorCode = 10002;
    public $msg = '数据未找到';


}