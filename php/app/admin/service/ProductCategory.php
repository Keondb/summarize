<?php

declare(strict_types=1);

namespace app\admin\service;

use app\model\ProductCategory as ProductCategoryModel;

class ProductCategory
{
    public function deleteByID($id)
    {
        $empty = true;
        if ($empty) {
            return ProductCategoryModel::destroy($id);
        } else {
            throw new \Exception('分类下有商品不能删除');
        }
    }
}
