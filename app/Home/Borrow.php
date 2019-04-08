<?php

namespace App\Home;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    //定义模型关联的数据表
    protected $table = 'borrow';
    //定义主键
    protected $primaryKey = 'id';
    //定义禁止操作时间
    public $timestamps = false;
    //设置允许写入的字段
    protected $fillable = ['id','lending_name','lending_bookname','lending_time','order','shoule_time','state'];
    //关联模型1对1
    public function borrow(){
        return $this -> hasOne('App\Home\Book','id','lending_bookname');
    }
    public function user(){
        return $this -> hasOne('App\Home\User','id','lending_name');
    }
}