<?php

namespace App\Home;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //定义模型关联的数据表
    protected $table = 'book';
    //定义主键
    protected $primaryKey = 'id';
    //定义禁止操作时间
    public $timestamps = false;
    //设置允许写入的字段
    protected $fillable = ['id','ISBN','book_name','book_author','press','publication_time','number','add_time','classify_id','avatar'];

    public function classify(){
        return $this -> hasOne('App\Home\Classify','id','classify_id');
    }
}