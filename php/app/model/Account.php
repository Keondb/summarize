<?php
declare (strict_types = 1);

namespace app\model;

/**
 * @mixin \BaseModel
 */
class Account extends BaseModel
{
    public function check($username,$password)  {
        $res = self::where(['username'=>$username,'password'=>$password])->find();
        return $res;
    }
}
