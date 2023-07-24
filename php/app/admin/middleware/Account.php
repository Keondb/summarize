<?php

namespace app\admin\middleware;


use app\admin\validate\Account as AccountValidate;
use app\lib\exception\Parameter;
use app\lib\exception\Miss;
use think\exception\ValidateException;
use app\model\Account as AccountModel;

class Account 
{
    public function handle($request, \Closure $next)
    {
        $params = $request->param();
        try {
            Validate(AccountValidate::class)->scene('login')->check($params);
        } catch (ValidateException $e) {
            //获取异常  自己接管异常处理
            // throw new \Exception($e->getMessage());
            // return json(['msg'=>$e->getMessage(),'code'=>300]);
            throw new Parameter([
                'msg'=>$e->getMessage()
            ]); 
        }
        $exist = (new AccountModel())->check($params['username'],$params['password']);
        if(!$exist){
            throw new Miss(); 
        }

        $params['id'] = $exist['account_id'];
        $params['scope'] = $exist['scope'];
        $request->params = $params;
        return $next($request);
    }
}