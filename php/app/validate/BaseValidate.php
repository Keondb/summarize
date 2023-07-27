<?php

namespace app\validate;

use app\lib\exception\Parameter;
use think\Validate;

class BaseValidate extends Validate
{
    public function  getDataByRule($arrays)
    {
        $currentScene = $this->currentScene;
        $scene = $this->scene;
        if (!array_key_exists($currentScene, $scene)) {
            throw new Parameter(['msg' => '检验scene值不存在']);
        }

        $rules = $scene[$currentScene];
        $newArray = [];
        foreach ($rules as $value) {
            $newArray[$value] = $arrays[$value];
        }
        return $newArray;
    }

    protected function canBeEmpty($value, $rule = '', $data = '', $field = '')
    {
        return true;
    }
    protected function isCommaString($value, $rule = '', $data = '', $field = '')
    {
        if (strpos($value,',')) {
            $spec_values = explode(',',$value);
            foreach ($spec_values as $spec_value) {
                if (!is_numeric($spec_value) || $spec_value == 0) {
                    return $field . '格式错误';
                }
            }
        }elseif (!is_numeric($value) || $value == 0) {
            return $field . '格式错误';
        }
        return true;
    }
}
