<?php

namespace app\admin\validate;

use think\Validate;

class Account extends Validate
{
    protected $rule =   [
        'username'  => 'require|max:25',
        'password'  => 'require',
    ];
    
    protected $message  =   [
        'username.require' => '名称必须',
        'username.max'     => '名称最多不能超过25个字符',
        'password.require' => '密码必须',
    ];

    protected $scene = [
        'login'  =>  ['username','password'],
    ];   
 
}
