<?php

declare(strict_types=1);

namespace app\admin\service;
use app\model\Account as AccountModel;
class Account
{
    public function getToken($params)
    {
        $scope = $params['scope'];
        $uid = $params['id'];
        $values = [
            'scope' => $scope,
            'uid' => $uid,
        ];
        $token = $this->saveToCache($values);  
        $save_data = [
            'last_ip' => get_client_ip(),
            'last_time'=>time()
        ];

        AccountModel::where('account_id ',$params['id'])->update($save_data);

        return $token;
    }

    private function saveToCache($values)
    {
        $token = $this->generateToken();
        $expire_in = config('secure.token_expire_in');
        $request = cache($token,json_encode($values),$expire_in);
        if (!$request) {
            throw new \Exception('服务器缓存异常');
        }

        return $token;
    }

    public static function generateToken()
    {
        $randeChar = getRandChar(32);
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        $tokenSalt = config('secure.token_salt');
        return md5($randeChar . $timestamp . $tokenSalt);
    } 
}
