<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;
//调用模型
use App\Home\Book;
use App\Home\Borrow;
class TestController extends Controller
{
    public function test(){
        return '控制器测试成功';
    }
    public function test2(){
        return '控制器测试成功';
    }
    //数据库增加
    public function add(){
        $db=DB::table('user')->insert([
            [
                'name'=>'test',
                 'pw'=>bcrypt('test'),
            ],
        ]);
        dd($db);
    }

    //数据库修改
    public function edit(){
        $db=DB::table('user')->where('id','1')->update([
            'username'=>'admin',
        ]);
        dd($db);
    }

    //数据库查询
    public function select(){
        //查询整个BOOK表
//        $db=DB::table('book')->get();
//        foreach ($db as $key=>$value) {
//            echo "ID是：{$value->Id}.名字是:{$value->name}.年龄是：{$value->age}</br>";
//        }
        //查询在book表中ID大于2 年龄小于30数据
//        $db=DB::table('book')->where('id','>','2')->where('age','<','30')->get();
//        //查询book表中ID为5的单行数据
//        $db=DB::table('book')->where('id','=','5')->first();
        //查询book表中ID为5的name数据
        $db=DB::table('user')->where('id','=','5')->value('username');
        //查询book表中全部的name和age数据
        //$db=DB::table('book')->select('name','age')->get();
        dd($db);
    }
    //数据库删除数据
    public function del(){
        $db=DB::table('book')->where('id','=','1')->delete();
        dd($db);
    }

    //使用模型向数据库添加数据
    public function add1(Request $request){
        $model=new Book();
        $model->create($request->all());
    }
    //一对一
    public function test1(){
        $data =Borrow::get();
        foreach ($data as $key => $value){
            echo $value->id .'<br>ISBN' .$value->borrow->ISBN .'<br>书名' .$value->borrow->book_name.'<br>作者'.$value->borrow->book_author.'<br>出版社'.$value->borrow->press.'<br>借出时间'.$value->lending_time.'<br>借出人'.$value->lengding_name;
        }
    }
    //多对多
    public function test3(){
        $date =\App\Home\Book::get();
        foreach ($date as $value){
            echo '<hr>'.$value->book_name;
            foreach ($value->book as $val){
                echo '<br>'.$val->username;
            }
        }
    }

}
