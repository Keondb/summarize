<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;

/**
 * @mixin \think\Model
 */
class BaseModel extends Model
{
    protected $hidden = [
        'create_time',
        'update_time',
        'delete_time',
    ];
}
