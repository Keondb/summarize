<?php

declare(strict_types=1);

namespace app\admin\controller;

use app\Request;
use app\model\ProductSpecsValue as ProductSpecsValueModel;
use app\admin\service\ProductSpecsValue as ProductSpecsValueService;

// 资源路由接口
class ProductSpecsValue
{
    public function index($page = 1, $size = 10)
    {   
        $list = (new ProductSpecsValueModel())->getPageData($page,$size);
        return sucess($list);
    }

    public function save(Request $request)
    {
        $data = $request->params;
        $res = (new ProductSpecsValueModel())->save($data);
        if (!$res) {
            return fail();
        }
        return sucess();
    }
    public function update(Request $request)
    {
        $data = $request->params;
        // 判断是否存在 存在为true
        $exist = !ProductSpecsValueModel::findOrEmpty($data['id'])->isEmpty();
        if (!$exist) {
            return fail('数据不存在');
        }
        $res = ProductSpecsValueModel::update($data);
        if (!$res) {
            return fail();
        }
        return sucess();
    }
    public function delete(Request $request)
    {
        $id = $request->params['id'];
        $res = (new ProductSpecsValueService())->deleteByID($id);
        if (!$res) {
            return fail();
        }
        return sucess();
    }
    public function read(Request $request)
    {
        $id = $request->params['id'];
        $res = ProductSpecsValueModel::find($id);
        if (!$res) {
            return fail();
        }
        return sucess($res);
    }
}
