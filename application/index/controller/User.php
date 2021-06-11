<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\facade\Session;


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
     * 用户登录  展示页面
     */
    public function login()
    {
        return $this->fetch();
    }

    /**
     * 登录逻辑处理
     */
    public function loginDo()
    {
        //根据用户名查询数据库
        $user_name = $_POST['u'];
        $pass = $_POST['pass'];

        $u = Db::table('p_users')->where("user_name",$user_name)->find();

        if($u){
            //验证密码
            if( password_verify($pass,$u['password']) ){

                //设置session
                Session::set('user_id',$u['user_id']);      // $_SEESION['user_id'] = $u['user_id']
                Session::set('user_name',$u['user_name']);
                //重定向至个人中心
                return redirect('/user/center');

            }else{
                echo "密码不正确";
            }

        }else{
            echo "用户不存在";
        }
    }


    /**
     * 个人中心
     */
    public function center()
    {

        $user_id = Session::get('user_id');
        //查询数据库用户信息
        $u = Db::table('p_users')->field('user_id,user_name,email,mobile')->where("user_id",$user_id)->find();

        $this->assign('name',$u['user_name']);
        $this->assign('email',$u['email']);
        return $this->fetch();
    }


}
