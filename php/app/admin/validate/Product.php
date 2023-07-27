<?php

namespace app\admin\validate;

use app\model\Product as ModelProduct;
use app\validate\BaseValidate;

class Product extends BaseValidate
{
    protected $specsRule = [
        'specs_value_id' =>  'require|isCommaString',
        'price' =>  'require|number',
        'stock' =>  'require|number',
    ];
    protected $specsMessage = [
        'price.require' => 'price规格必须', 
        'stock.require' => 'stock规格必须', 
    ];

    protected function checkSpecs($value, $rule = '', $data = '', $field = '')
    {
        if (isset($value) && !is_array($value)) {
            return $field . '规格类型错误';
        }
        $validate = new Product();
        foreach ($value as $item) {  
            if (!is_array($item)) {
                return $field . '规格数据错误';
            }
            $validate->message = $this->specsMessage;
            $result = $validate->check($item,$this->specsRule);
            if (!$result) {
                throw new \Exception($validate->error);
            }
        }
        return true;
    }

    protected $rule =   [
        'id'  => 'require|number',
        'cat_id'  => 'require',
        'name'  => 'require',
        'image'  => 'require',
        'price'  => 'require',
        'slide_image'  => 'require',
        'stock'  => 'require',
        'is_hot'  => 'in:0,1',
        'specs_type'  => 'in:0,1',
        'specs'  => 'require|checkSpecs',
    ];

    protected $message  =   [
        'id.require' => 'id必须',
        'cat_id.require' => 'cat_id必须',
        'name.require' => 'name必须',
        'image.require' => 'image必须',
        'price.require' => 'price必须',
        'slide_image.require' => 'slide_image必须',
        'stock.require' => 'stock必须',
        'is_hot.require' => 'is_hot必须',
        'specs.require' => 'specs必须',
    ];

    protected $scene = [
        'save'  =>  ['cat_id', 'name', 'image', 'price', 'slide_image', 'stock', 'is_hot', 'specs_type', 'specs'],
        'delete'  =>  ['id'],
        'update'  =>  ['id', 'cat_id', 'name', 'image', 'price', 'slide_image', 'stock', 'is_hot', 'specs_type', 'specs'],
        'read'  =>  ['id'],
    ];
}
