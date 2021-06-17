<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class Orders extends Controller
{
    //数据统计
    public function info()
    {

        //消费最多的前10个用户

        // 订单最多的前10个用户信息

        //卖的最多的前10个商品

        //订单的平均金额

        //人均消费

        return $this->fetch();
    }
}
