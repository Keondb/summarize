<?php

declare(strict_types=1);

namespace app\admin\controller;

use app\Request;
use app\model\ProductSpecsName as ProductSpecsNameModel;
use app\admin\service\ProductSpecsName as ProductSpecsNameService;

// 资源路由接口
class ProductSpecsName
{
    public function index($page = 1, $size = 10)
    {   
        $list = (new ProductSpecsNameModel())->getPageData($page,$size);
        return sucess($list);
    }

    public function save(Request $request)
    {
        $data = $request->params;
        $res = (new ProductSpecsNameModel())->save($data);
        if (!$res) {
            return fail();
        }
        return sucess();
    }
    public function update(Request $request)
    {
        $data = $request->params;
        // 判断是否存在 存在为true
        $exist = !ProductSpecsNameModel::findOrEmpty($data['id'])->isEmpty();
        if (!$exist) {
            return fail('数据不存在');
        }
        $res = ProductSpecsNameModel::update($data);
        if (!$res) {
            return fail();
        }
        return sucess();
    }
    public function delete(Request $request)
    {
        $id = $request->params['id'];
        $res = (new ProductSpecsNameService())->deleteByID($id);
        if (!$res) {
            return fail();
        }
        return sucess();
    }
    public function read(Request $request)
    {
        $id = $request->params['id'];
        $res = ProductSpecsNameModel::find($id);
        if (!$res) {
            return fail();
        }
        return sucess($res);
    }
}
