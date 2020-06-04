<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    // articles 表
    protected $table = 'articles';
    //模型自动维护当前时间戳
    public $timestamps = false;
    //批量赋值属性 在使用模型添加的时候必须设置该属性
    protected $fillable = ['title','descr','thumb','editor'];
}
