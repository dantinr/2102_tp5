<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use think\facade\Session;

class Prize extends Controller
{
    public function index()
    {

        //判断用户是否登录
        $uid = Session::get('user_id');
        if(empty($uid)){
            return redirect('/user/login');
        }

        //当前时间戳
        $now = time();
        $before = $now - 60;
        //echo "当前时间戳： ".$now . ">>>> " .  date('Y-m-d H:i:s',$now); echo '</br>';
        //echo "一分钟之前: ".$before . '>>>>' . date('Y-m-d H:i:s',$before);echo '</br>';

        //根据时间戳获取抽奖次数
        //select count(*) as num from prize where uid={$uid} and add_time>$before
        $num = Db::table('prize')->where("uid",$uid)->count();
        var_dump($num);
        if($num>=3){        //等下一分钟
            echo "抽奖次数受限";
            die;
        }

        // 生成随机数
        $rand_num = mt_rand(1,100);
        echo "随机数： ". $rand_num;echo '</br>';

        if($rand_num == 1){
            echo "一等奖";
        }elseif ($rand_num==2 || $rand_num==3){
            echo "二等奖";
        }elseif($rand_num==4 || $rand_num==5 || $rand_num==6){
            echo "三等奖";
        }

        //入库
        $data = [
            'uid'           => $uid,
            'add_time'      => $now,
            'rand_num'      => $rand_num
        ];

        $row_num = Db::table('prize')->insert($data);

    }
}
