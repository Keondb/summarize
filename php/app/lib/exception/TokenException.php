<?php

namespace app\lib\exception;


class TokenException extends BaseException{
    public $httpStatus = 401;
    public $errorCode = 10003;
    public $msg = 'token过期或无效';
}