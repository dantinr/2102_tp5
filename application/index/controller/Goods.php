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

}
