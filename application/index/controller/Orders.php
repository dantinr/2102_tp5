<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model\Orders as OrderModel;

class Orders extends Controller
{

    /**
     * 订单列表
     */
    public function olist()
    {

        //使用 模型
        $list = OrderModel::field('order_id,user_id,goods_amount,add_time')
            ->order('order_id','desc')->limit(10)->select()->toArray();


        //1 使用查询构造器 Db::
        //获取 最新的10个订单
//        $list = Db::table('p_order_info')->field('order_id,user_id,goods_amount,add_time')
//            ->order('order_id','desc')->limit(10)->select();
//        dump($list);

        foreach($list as $k=>$v){
            $list[$k]['add_time2'] = date('Y-m-d H:i:s',$v['add_time']);
        }
        //echo '<pre>';print_r($list);echo '</pre>';die;
        $this->assign('list',$list);
        return $this->fetch();
    }

    //数据统计
    public function info()
    {

        //消费最多的前10个用户
        $list = Db::table('p_order_info')->alias('b')
            ->field('a.user_id,a.user_name,a.reg_time,sum(b.goods_amount) as total')
            ->join('p_users a','a.user_id=b.user_id')
            ->group('b.user_id')
            ->order('total','desc')
            ->limit(10)
            ->select();

        dump($list);



        // 订单最多的前10个用户信息

        //卖的最多的前10个商品

        //订单的平均金额

        //人均消费

        return $this->fetch();
    }

    public function test()
    {
        $data = [
            ['user_name'=>"zhangsan",'email'=>'zhangsan@qq.com','age'=>11],
            ['user_name'=>"lis",'email'=>'lisi@qq.com','age'=>22],
        ];
        Db::table('users')->insertAll($data);
    }
}
