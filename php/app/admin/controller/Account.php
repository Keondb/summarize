<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\Request;
use app\admin\service\Account as AccountService;

class Account
{
    public function login(Request $request)
    {
        $params = $request->params;
        $token = (new AccountService())->getToken($params);
        return sucess($token);
    }

    public function info(Request $request) {
        $uid = $request->uid;
        return sucess(['uid'=>$uid]);
    }
}
