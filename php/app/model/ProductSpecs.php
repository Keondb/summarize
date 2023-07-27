<?php
declare (strict_types = 1);

namespace app\model;
use think\model\concern\SoftDelete;
/**
 * @mixin \BaseModel
 */
class ProductSpecs extends BaseModel
{
    use SoftDelete;
    
    protected $autoWriteTimestamp = true;

    public function getPageData($page,$size)  {
        return self::paginate($size,false,[
            'page'=>$page
        ]);
    }
}
