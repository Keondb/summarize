<?php

declare(strict_types=1);

namespace app\admin\service;

use app\model\Product as ProductModel;
use app\model\ProductSpecs;

class Product
{
    /**
     * $data['specs']
     */
    public function edit($data)
    {
        $model = new ProductModel();
        $model->startTrans();
        try {
            if (isset($data['id'])) {
                // 更新商品得时候切换模型
                $model = $model->where('id', $data['id'])->find();
            }
            $prodSaveRes = $model->save($data);

            if (!$prodSaveRes) {
                throw new \Exception('商品保存失败');
            }
            $specs_arr = $data['specs'];

            $stock = 0;
            $product_id = $model->id;
            if (isset($data['id'])) {
                // 更新商品得时候切换模型
                $product_del_res = (new ProductSpecs())->where(['product_id' => $product_id])->delete();
                if (!$product_del_res) {
                    throw new \Exception('商品规格删除失败');
                }
            }
            foreach ($specs_arr as &$specs) {
                $stock += $specs['stock'];
                $specs['product_id'] = $product_id;
                $ProductSpecsSave = (new ProductSpecs())->save($specs);
                if (!$ProductSpecsSave) {
                    throw new \Exception('商品规程保存出错');
                }
            }

            $prodStockRes = $model->where('id', $product_id)->save(['stock' => $stock]);
            if (!$prodStockRes) {
                throw new \Exception('商品库存保存出错');
            }
            $model->commit();
            return true;
        } catch (\Exception $e) {
            $model->rollback();
            throw new \Exception($e->getMessage());
            return false;
        }
    }

    public function deleteByID($id)
    {
        $empty = true;
        if ($empty) {
            return ProductModel::destroy($id);
        } else {
            throw new \Exception('操作失败');
        }
    }
}
