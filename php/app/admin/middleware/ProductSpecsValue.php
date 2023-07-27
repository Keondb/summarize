<?php

namespace app\admin\middleware;

use app\admin\validate\ProductSpecsValue as ProductSpecsValueValidate;
use app\lib\exception\Parameter;
use app\model\ProductSpecsValue as ProductSpecsValueModel;

class ProductSpecsValue
{
    public function handle($request, \Closure $next)
    {
        $params = $request->param();
        $action = $request->action();
        if ($action != 'index') {
            $scene =  validate(ProductSpecsValueValidate::class)->scene($action);
            $scene->check($params);
            $params = $scene->getDataByRule($params);
    
            self::getToProductSpecsValue($params['id']);
            $request->params = $params;
        }
  

        return $next($request);
    }
    // 
    private static function getToProductSpecsValue($id)
    {
        // 判断是否存在 存在为true
        $exist = !ProductSpecsValueModel::findOrEmpty($id)->isEmpty();
        if (!$exist) {
            throw new Parameter(['msg'=>'数据不存在']);
        }
    }
}
