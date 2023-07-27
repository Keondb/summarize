<?php

namespace app\admin\middleware;

use app\admin\validate\Product as ProductValidate;
use app\lib\exception\Parameter;
use app\model\Product as ProductModel;

class Product
{
    public function handle($request, \Closure $next)
    {
        $params = $request->param();
    
        $action = $request->action();
        if ($action != 'index') {
                 
            $scene =  validate(ProductValidate::class)->scene($action);
            $scene->check($params);
            // var_dump($params);exit;    
            $params = $scene->getDataByRule($params);
      
            if ($action != 'save') {
                self::getToProduct($params['id']);
            }
        }
        
        $request->params = $params;
        return $next($request);
    }
    // 
    private static function getToProduct($id)
    {
        // 判断是否存在 存在为true
        $exist = !ProductModel::findOrEmpty($id)->isEmpty();
        if (!$exist) {
            throw new Parameter(['msg'=>'数据不存在']);
        }
    }
}
