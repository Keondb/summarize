<?php

namespace app\admin\validate;

use app\validate\BaseValidate;
use think\Validate;

class ProductCategory extends BaseValidate
{
    protected $rule =   [
        'id'  => 'require|number',
        'name'  => 'require',
        'pid'  => 'number', 
        'pic'  => 'canBeEmpty',
        'sort' => 'canBeEmpty',
    ];
    
    protected $message  =   [
        'name.require' => '名称必须',
    ];

    protected $scene = [
        // 'index' =>['']
        'save'  =>  ['name','pic','pid','sort'],
        'delete'  =>  ['id'],
        'update'  =>  ['id','name','pic','pid','sort'],
        'read'  =>  ['id'],
    ];   
 
}
