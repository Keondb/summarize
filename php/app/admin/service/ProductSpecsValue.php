<?php

declare(strict_types=1);

namespace app\admin\service;

use app\model\ProductSpecsValue as ProductSpecsValueModel;

class ProductSpecsValue
{
    public function deleteByID($id)
    {
        $empty = true;
        if ($empty) {
            return ProductSpecsValueModel::destroy($id);
        } else {
            throw new \Exception('操作失败');
        }
    }
}
