<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\facade\Session;

class Movie extends Controller
{


    /**
     * 投票页面
     */
    public function vote()
    {
        $list = Db::table("movies")->select();
        foreach($list as $k=>$v){
            //计算当前电影id的平均分
            $avg = ceil( Db::table('movies_score')->where('movie_id',$v['id'])->avg('score') );
            $list[$k]['score'] = $avg;
        }
        $this->assign('list',$list);
        return $this->fetch();
    }

    /**
     * 电影评分 逻辑
     */
    public function voteDo()
    {

        //获取登录用户id
        $uid = Session::get('user_id');
        //当前时间戳
        $now = time();

        //判断用户是否登录
        if($uid){

        }else{
            return redirect("/user/login");
        }


        echo '<pre>';print_r($_POST);echo '</pre>';

        foreach($_POST as $k=>$v)
        {

            if(intval($v) == 0){
                die("不能为空");
            }
            //echo "电影ID： ". $k. "电影评分： ". $v;echo '</br>';
            $data = [
                'movie_id'  => $k,
                'score'     => $v,
                'uid'       => $uid,
                'add_time'  => $now
            ];
            Db::table("movies_score")->insert($data);
        }
    }

    /**
     * 订座页面
     */
    public function seat()
    {
        //计算今天开始的时间戳
        $today_timestamp = strtotime(date("Y-m-d"));
        echo $today_timestamp;echo '</br>';

        $list = Db::table('seats')->where('add_time','>',$today_timestamp)->select();
        echo '<pre>';print_r($list);echo '</pre>';
        $this->assign('list',$list);
        return $this->fetch();
    }

    /**
     * 作为预订
     */
    public function booking()
    {
        $uid = Session::get('user_id');
        echo '<pre>';print_r($_POST);echo '</pre>';
        $data = [
            'seat_no'   => intval($_POST['seat_no']),
            'uid'       => $uid,
            'add_time'  => time()
        ];
        $res = Db::table('seats')->insert($data);
        var_dump($res);
        return redirect('/user/center');
    }

}
