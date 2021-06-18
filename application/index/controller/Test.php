<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use think\facade\Request;

class Test extends Controller
{

    public function form1()
    {

        $req = request()->param();
        dump($req);
//        echo '<pre>';print_r($_GET['xxx']);echo '</pre>';
//        //$this->success('XXX成功','/user/center');
//        //$this->error('XXX失败,正在跳转至登录页面','/user/login');
//        $this->assign('xxx',$_GET['xxx']);
//        return $this->fetch();
    }

    public function test1()
    {
        echo '<pre>';print_r($_GET);echo '</pre>';
        echo '<pre>';print_r(Request::param('username'));echo '</pre>';echo '</br>';
        echo '<pre>';print_r(Request::param('email'));echo '</pre>';echo '</br>';
        echo '<pre>';print_r(Request::param());echo '</pre>';

//        echo '<pre>';print_r($_GET);echo '</pre>';
//        echo '<pre>';print_r($_POST);echo '</pre>';
//        echo '<hr>';
//        echo "用户名：" . $this->request->param('username');echo '</br>';
//        echo '<pre>';print_r($this->request->param());echo '</pre>';
    }

    /**
     * 随机添加数据
     */
    public function addStu()
    {
        echo __METHOD__;echo '</br>';

        //添加多条
        $data = [
            ['stu_name'=>"lisi",'sex'=>0,'age'=>18,'score'=>77],
            ['stu_name'=>"wangwu",'sex'=>1,'age'=>19,'score'=>66],
            ['stu_name'=>"zhaoliu",'sex'=>1,'age'=>20,'score'=>55],
        ];

        $num = Db::name('student')->insertAll($data);
        echo "insert 条数： ". $num;echo '<hr>';
        die;


        //添加一条
        $data = [
            'stu_name'  => 'zhangsan',
            'sex'       => 1,
            'age'       => 20,
            'score'     => 99
        ];

        // 向 student 表中添加一条数据
        // insert into student (`stu_name`,`sex`,`age`,`score`) values ('zhangsan',1,20,99)
        $num = Db::name('student')->insert($data);
        //获取 原生sql语句
        echo "获取sql语句：" . Db::getLastSql();
    }

    /**
     * 随机添加100条记录
     */
    public function add100()
    {


        for($i=0;$i<100;$i++)
        {
            //生成随机字符串
            $name = $this->randomStr(6);
            $sex = mt_rand(0,1);
            $age = mt_rand(18,30);
            $score = mt_rand(20,100);

            $data = [
                'stu_name'  => $name,
                'sex'       => $sex,
                'age'       => $age,
                'score'     => $score
            ];

            Db::name('student')->insert($data);
        }

    }

    /**
     * 随机生成字符串
     */
    private function randomStr($num=6)
    {
        $str0 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijk';
        $res = "";
        for($i=0;$i<$num;$i++)
        {
            $rad = mt_rand(0,36);
            $res .= $str0[$rad];
        }

        return $res;

    }



}
