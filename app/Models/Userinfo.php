<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{
    protected $table = 'user_info';
    //模型自动维护当前时间戳
    public $timestamps = false;

  

}
