<?php

declare(strict_types=1);

namespace app\admin\service;

use app\lib\exception\Forbindden;
use app\lib\exception\TokenException;

class Token
{
    private static $token = '';

    public static function checkPrimaryScope(string $token) :int {
        self::$token = $token;
        $scope = self::getCurrentTokenVar('scope');
        if ($scope) {
            if ($scope >= config('scope.User')) {
                return self::getCurrentTokenVar('uid');
            }else{
                throw new TokenException();
            }
        }else{
            throw new Forbindden();
        }
    }

    public static function getCurrentTokenVar(String $key) {
        $vars = cache(self::$token);
        if (!$vars) {
            throw new TokenException();
        }else{
            if(!is_array($vars)){
                $vars = json_decode($vars,true);
            }
            if (array_key_exists($key,$vars)) {
                return $vars[$key];
            }else{
                throw new TokenException(['msg'=>'没有相关权限']);
            }
        }
    }
}
