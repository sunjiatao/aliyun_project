<?php

namespace App\Http\Controllers\Demo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DemoController extends Controller
{
    //案例主页
    public function index(){
        return view('Demo.Index.index');
    }


    //扫码手机端
    public function phoneScanLogin($code){
        return view('Demo.Index.phoneScan',['code'=>$code]);
    }
}
