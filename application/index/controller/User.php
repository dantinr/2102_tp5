<?php
namespace app\index\controller;
use think\Controller;


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

}
