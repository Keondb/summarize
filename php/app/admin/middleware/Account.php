<?php

namespace app\admin\middleware;


use app\admin\validate\Account as AccountValidate;
use app\lib\exception\Parameter;
use think\exception\ValidateException;

class Account 
{
    public function handle($request, \Closure $next)
    {
        $params = $request->param();
        try {
            Validate(AccountValidate::class)->scene('login')->check($params);
        } catch (ValidateException $e) {
            //获取异常  自己接管异常处理
            throw new \Exception($e->getMessage());
            // return json(['msg'=>$e->getMessage(),'code'=>300]);
            // throw new Parameter(); 
        }
        return $next($request);
    }
}