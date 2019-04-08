<?php

namespace App\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
class Admin extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    //定义模型关联的数据表
    protected $table = 'admin';
    //定义主键
    protected $primaryKey = 'id';
    //定义禁止操作时间
    public $timestamps = false;
    //设置允许写入的字段
    protected $fillable = ['id','username','password','remember_token'];

    use Authenticatable;
}
