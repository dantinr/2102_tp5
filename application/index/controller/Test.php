<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use think\facade\Request;
use think\facade\Session;

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

        echo Session::get('user_id');echo '</br>';
        echo  session('user_id');echo '</br>';
        die;

        $str1 = "%a-b-c-d-e-f-g&";
        echo "源字符串: ". $str1;echo '</br>';
        echo "strrev: ". strrev($str1);echo '</br>';
        echo 'md5: '. md5($str1);echo '</br>';
        echo 'sha1: ' . sha1($str1);echo '</br>';
        echo 'ltrim: '.ltrim($str1,'%');echo '</br>';
        echo 'trim: '.rtrim($str1,'&');echo '</br>';
        echo '<hr>';
        //计算字符串长度
        $len = strlen($str1);
        //截取字符串
        $str2 = substr($str1,2,5);
        //获取位置
        echo strpos($str1,'b');




//        $arr1 = explode('-',$str1);
//        dump($arr1);

//        $arr2 = ['a','b','c','d'];
//        $str2 = implode('#',$arr2);
//        dump($str2);

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
