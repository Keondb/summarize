<?php

namespace app\admin\middleware;

use app\admin\validate\ProductSpecsName as ProductSpecsNameValidate;
use app\lib\exception\Parameter;
use app\model\ProductSpecsName as ProductSpecsNameModel;

class ProductSpecsName
{
    public function handle($request, \Closure $next)
    {
        $params = $request->param();
        $action = $request->action();
        if ($action != 'index') {
            $scene =  validate(ProductSpecsNameValidate::class)->scene($action);
            $scene->check($params);
            $params = $scene->getDataByRule($params);
    
            self::getToProductSpecsName($params['id']);
            $request->params = $params;
        }
  

        return $next($request);
    }
    // 
    private static function getToProductSpecsName($id)
    {
        // 判断是否存在 存在为true
        $exist = !ProductSpecsNameModel::findOrEmpty($id)->isEmpty();
        if (!$exist) {
            throw new Parameter(['msg'=>'数据不存在']);
        }
    }
}
