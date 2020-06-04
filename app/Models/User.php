<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //写出与user模型类对应的数据表user
    protected $table = 'user';
    //模型自动维护当前时间戳
    public $timestamps = true;
    //批量赋值属性 在使用模型添加的时候必须设置该属性
    protected $fillable = ['name','password','email','status','phone','token'];
    // 修改器 获取到的字段值自动处理
    public function getStatusAttribute($value){
    	$status = [1=>'禁用',2=>'激活',0=>'未激活'];
    	return $status[$value];
    }
   	//一堆一
   	public function info(){

   		return $this->hasOne('App\Models\Userinfo','user_id');
   	}
   	//通过user模型类和address模型类的关系获取所有收货地址
   	public function address(){
   		return $this->hasMany('App\Models\Useraddress','user_id');

   		
   	}
}
