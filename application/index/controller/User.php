<?php
namespace app\index\controller;
use think\Controller;
use think\Db;


class User extends Controller
{
    /**
     * 用户注册 前台展示
     */
    public function reg()
    {
        // 显示视图
        return $this->fetch();          //显示模板
    }

    /**
     * 注册逻辑
     */
    public function reg2()
    {
        echo '<pre>';print_r($_POST);echo '</pre>';
        // 入库
    }


    /**
     * 用户登录
     */
    public function login()
    {
        return $this->fetch();
    }


    /**
     * 个人中心
     */
    public function center()
    {

        $user_id = 123;
        //查询数据库用户信息
        $u = Db::table('p_users')->field('user_id,user_name,email,mobile')->where("user_id",$user_id)->find();

        $this->assign('name',$u['user_name']);
        $this->assign('email',$u['email']);
        return $this->fetch();
    }


}
