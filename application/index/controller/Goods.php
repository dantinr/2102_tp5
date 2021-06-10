<?php
namespace app\index\controller;
use think\Db;

class Goods
{
    /**
     * 商品详细信息
     */
    public function detail($id=0)
    {
        echo "商品id: ". $id;
    }

}
