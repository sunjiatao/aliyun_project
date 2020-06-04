<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeRegister extends Model
{
     //写出与user模型类对应的数据表user
    protected $table = 'user';
    //模型自动维护当前时间戳
    public $timestamps = true;
    //批量赋值属性 在使用模型添加的时候必须设置该属性
    protected $fillable = ['name','password','email','status','token','phone'];
}
