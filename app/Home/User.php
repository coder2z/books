<?php

namespace App\Home;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Auth\Authenticatable;
class User extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    //
    //定义模型关联的数据表
    protected $table = 'user';
    //定义主键
    protected $primaryKey = 'id';
    //定义禁止操作时间
    public $timestamps = false;
    //设置允许写入的字段
    protected $fillable = ['id','username','password','tel','email','time','state',];

    use Authenticatable;
}