<?php

namespace app\admin\middleware;

use app\admin\service\Token;
use app\lib\exception\TokenException;

class Auth 
{
    public function handle($request, \Closure $next)
    {
        $token = $request->header('token');
        if (!$token) {
            throw new TokenException();
        }
        $uid = Token::checkPrimaryScope($token);
        $request->uid = $uid;
        return $next($request);
    }
}