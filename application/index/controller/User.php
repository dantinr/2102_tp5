<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\facade\Session;
//引入User 模型
use app\index\model\User as UserModel;


class User extends Controller
{


    /**
     * 通过模型获取 用户列表
     */
    public function test1()
    {
        //使用模型 UserModel
        $u = UserModel::where("userid",79)->find();
        //var_dump($u);
        echo '<pre>';print_r($u);echo '</pre>';
        echo '<hr>';

        echo "用户名： ". $u->username;echo '</br>';
        echo "Email： ". $u->email;echo '</br>';
    }

    /**
     * 通过模型 insert 数据
     */
    public function test2()
    {
        $u = new UserModel();
        $u->username = "zhangsan222";
        $u->email = 'zhangsan222@qq.com';
        $u->mobile = '13312347777';
        $num = $u->save();
        var_dump($num);

    }

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
     * 退出登录
     */
    public function logout()
    {
        //清除 session中 的用户信息
        Session::delete('user_id');
        Session::delete('user_name');

        //跳转页面
        return redirect('/user/login');
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

                // 记录登录历史
                $history = [
                    'uid'           => $u['user_id'],
                    'login_time'    => time(),
                    'login_ip'      => $_SERVER['REMOTE_ADDR'],     // ip
                    'ua'            => $_SERVER['HTTP_USER_AGENT'], // ua
                ];
                Db::table('login_history')->insert($history);

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

        //判断用户登录状态
        $sess = Session::get();

        if(empty($sess['user_id']) && empty($sess['user_name'])){
            // 未登录
            return redirect('/user/login');
        }

        $user_id = Session::get('user_id');
        //查询数据库用户信息
        $u = Db::table('p_users')->field('user_id,user_name,email,mobile')->where("user_id",$user_id)->find();

        //查询用户的登录历史
        $history = Db::table('login_history')->where('uid',$user_id)->select();
        //处理字段
        foreach ($history as $k=>$v){
            $history[$k]['login_time'] = date('Y-m-d H:i:s',$v['login_time']);
        }

        $this->assign('name',$u['user_name']);
        $this->assign('email',$u['email']);
        $this->assign('history',$history);
        return $this->fetch();
    }

    /**
     * 我的预订
     */
    public function seat()
    {
        $uid = Session::get('user_id');
        $list = Db::table('seats')->where('uid',$uid)->select();

        $this->assign('seats',$list);
        return $this->fetch();
    }

}
