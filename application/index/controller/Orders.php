<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class Orders extends Controller
{

    /**
     * 订单列表
     */
    public function olist()
    {

        //使用 模型



        //1 使用查询构造器 Db::
        //获取 最新的10个订单
//        $list = Db::table('p_order_info')->field('order_id,user_id,goods_amount,add_time')
//            ->order('order_id','desc')->limit(10)->select();
//        dump($list);
    }

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
