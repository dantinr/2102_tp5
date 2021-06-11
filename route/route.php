<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

//当用户访问 xxx.com/hello/xxx  , 找到 Index控制器中的 hello方法
Route::get('hello/:name', 'index/hello');

//商品
Route::get('goods/:id', 'goods/detail');         //商品详情

//用户
Route::get('user/login','user/login');      //登录
Route::get('user/reg', 'user/reg');         // 用户注册

Route::get('test/addstu','test/addStu');        //随机添加数据
Route::get('test/add100','test/add100');        //随机添加数据


return [

];
