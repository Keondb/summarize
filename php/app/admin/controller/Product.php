<?php

declare(strict_types=1);

namespace app\admin\controller;

use app\Request;
use app\model\Product as ProductModel;
use app\admin\service\Product as ProductService;

// 资源路由接口
class Product
{
    public function index($page = 1, $size = 10)
    {   
        $list = (new ProductModel())->getPageData($page,$size);
        return sucess($list);
    }

    public function save(Request $request)
    {
        $check = $request->checkToken('__token__');
        echo 12345;
        var_dump($check);exit;
        if(false === $check){
            throw new \Exception('invalid token');
        }
        echo 123456666; exit;
        $data = $request->params;
        $res = (new ProductService())->edit($data);
        if (!$res) {
            return fail();
        }
        return sucess();
    }
    public function update(Request $request)
    {
        $data = $request->params;
        // 判断是否存在 存在为true
        $exist = !ProductModel::findOrEmpty($data['id'])->isEmpty();
        if (!$exist) {
            return fail('数据不存在');
        }
        $res = ProductModel::update($data);
        if (!$res) {
            return fail();
        }
        return sucess();
    }
    public function delete(Request $request)
    {
        $id = $request->params['id'];
        $res = (new ProductService())->deleteByID($id);
        if (!$res) {
            return fail();
        }
        return sucess();
    }
    public function read(Request $request)
    {
        $id = $request->params['id'];
        $res = ProductModel::find($id);
        if (!$res) {
            return fail();
        }
        return sucess($res);
    }
}
