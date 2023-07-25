<?php

declare(strict_types=1);

namespace app\admin\controller;

use app\Request;
use app\model\ProductCategory as ProductCategoryModel;
use app\admin\service\ProductCategory as ProductCategoryService;

// 资源路由接口
class ProductCategory
{
    public function index($page = 1, $size = 10)
    {   
        $list = (new ProductCategoryModel())->getPageData($page,$size);
        return sucess($list);
    }

    public function save(Request $request)
    {
        $data = $request->params;
        $res = (new ProductCategoryModel())->save($data);
        if (!$res) {
            return fail();
        }
        return sucess();
    }
    public function update(Request $request)
    {
        $data = $request->params;
        // 判断是否存在 存在为true
        $exist = !ProductCategoryModel::findOrEmpty($data['id'])->isEmpty();
        if (!$exist) {
            return fail('数据不存在');
        }
        $res = ProductCategoryModel::update($data);
        if (!$res) {
            return fail();
        }
        return sucess();
    }
    public function delete(Request $request)
    {
        $id = $request->params['id'];
        $res = (new ProductCategoryService())->deleteByID($id);
        if (!$res) {
            return fail();
        }
        return sucess();
    }
    public function read(Request $request)
    {
        $id = $request->params['id'];
        $res = ProductCategoryModel::find($id);
        if (!$res) {
            return fail();
        }
        return sucess($res);
    }
}
