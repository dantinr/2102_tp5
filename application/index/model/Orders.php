<?php

namespace app\index\model;

use think\Model;

class Orders extends Model
{
    //指定表
    protected $table = 'p_order_info';
    //指定 主键
    protected $pk = 'order_id';

}
