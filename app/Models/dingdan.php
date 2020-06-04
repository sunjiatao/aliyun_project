<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dingdan extends Model
{
     //写出与user模型类对应的数据表user
    protected $table = 'dingdan';
    //模型自动维护当前时间戳
    public $timestamps = true;
    //批量赋值属性 在使用模型添加的时候必须设置该属性
    protected $fillable = ['order_id','user_id','status'];
    // 修改器 获取到的字段值自动处理
    public function getStatusAttribute($value){
    	$status = [0=>'未发货',1=>'已发货',2=>'退款'];
    	return $status[$value];
    }
}
