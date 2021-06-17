<?php
    namespace app\index\model;

    use think\Model;


    class User extends Model {

        //指定当前模型使用的表
        protected $table = 'users';

        //指定表的主键
        protected $pk = 'userid';
    }
