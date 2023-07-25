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
}
