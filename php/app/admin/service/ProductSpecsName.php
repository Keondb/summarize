<?php

declare(strict_types=1);

namespace app\admin\service;

use app\model\ProductSpecsName as ProductSpecsNameModel;

class ProductSpecsName
{
    public function deleteByID($id)
    {
        $empty = true;
        if ($empty) {
            return ProductSpecsNameModel::destroy($id);
        } else {
            throw new \Exception('操作失败');
        }
    }
}
