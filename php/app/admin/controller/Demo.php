<?php

declare(strict_types=1);

namespace app\admin\controller;

use app\Request;

class Demo
{
    public function index(Request $request)
    {
        $token = $request->buildToken('__token__', 'sha1');
        echo $token;
        echo 6666;
        $token = $request->getToken();
        return sucess(['token' => $token]);
    }
}
