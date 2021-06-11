<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class Goods extends Controller
{
    /**
     * 商品详细信息
     */
    public function detail($id=0)
    {
        //根据id查询数据库数据
        $goods = Db::table('p_goods')->field('goods_id,goods_name,shop_price')
            ->where('goods_id',$id)->find();

        if($goods){
            $this->assign('goods_name',$goods['goods_name']);
            $this->assign('price',$goods['shop_price']);
            return $this->fetch();
        }else{
            echo "没有此商品信息";
            die;
        }

    }

    /**
     * 商品列表
     */
    public function goodsList()
    {
        // 每页显示 10 条
        $list = Db::table('p_goods')->field('goods_id,goods_name,shop_price')
            ->order('goods_id','desc')->limit(10)->select();

        //echo '<pre>';print_r($list);echo '</pre>';

        //渲染视图
        $this->assign('list',$list);
        return $this->fetch();
    }

}
