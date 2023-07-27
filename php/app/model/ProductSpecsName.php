<?php
declare (strict_types = 1);

namespace app\model;
use think\model\concern\SoftDelete;
/**
 * @mixin \BaseModel
 */
class ProductSpecsName extends BaseModel
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    
    protected $autoWriteTimestamp = true;

    public function getPageData($page,$size)  {
        return self::paginate($size,false,[
            'page'=>$page
        ]);
    }
}
