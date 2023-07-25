<?php

namespace app\admin\middleware;

use app\admin\validate\ProductCategory as ProductCategoryValidate;
use app\lib\exception\Parameter;
use app\model\ProductCategory as ProductCategoryModel;

class ProductCategory
{
    public function handle($request, \Closure $next)
    {
        $params = $request->param();
        $action = $request->action();
        if ($action != 'index') {
            $scene =  validate(ProductCategoryValidate::class)->scene($action);
            $scene->check($params);
            $params = $scene->getDataByRule($params);
    
            self::getToProductCategory($params['id']);
            $request->params = $params;
        }
  

        return $next($request);
    }
    // 
    private static function getToProductCategory($id)
    {
        // 判断是否存在 存在为true
        $exist = !ProductCategoryModel::findOrEmpty($id)->isEmpty();
        if (!$exist) {
            throw new Parameter(['msg'=>'数据不存在']);
        }
    }
}
