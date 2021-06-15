<?php
namespace app\index\controller;
use think\Db;
use think\Controller;

class Book extends Controller
{
    /**
     * 添加页面
     */
    public function add()
    {
        return $this->fetch();
    }

    /**
     * 添加逻辑
     */
    public function addDo()
    {
        $_POST['add_time'] = time();
        $num = Db::table('books')->insert($_POST);
        var_dump($num);
    }

    /**
     * 列表页
     */
    public function bookList()
    {
       $list = Db::table('books')->limit(10)->select();
       //echo '<pre>';print_r($list);echo '</pre>';

       $this->assign('list',$list);
       return $this->fetch();
    }

    /**
     * 删除
     */
    public function del($id)
    {
        echo "ID: ". $id;
        $num = Db::table('books')->where("id",$id)->delete();
        if($num)
        {
            return redirect('/book/list');
        }else{
            echo "删除失败";
        }
    }
}
