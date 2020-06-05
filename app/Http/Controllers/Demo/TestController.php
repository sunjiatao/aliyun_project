<?php

namespace App\Http\Controllers\Demo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    //
    public function index(){

        $arr = '{"address":"CN|\u5317\u4eac|\u5317\u4eac|None|DXTNET|0|0","content":{"address":"\u5317\u4eac\u5e02","address_detail":{"city":"\u5317\u4eac\u5e02","city_code":131,"district":"","province":"\u5317\u4eac\u5e02","street":"","street_number":""},"point":{"x":"116.40387397","y":"39.91488908"}},"status":0}';

        $data = json_decode($arr, 'array');
        echo "<pre>";
 print_r($data);
        print_r($_SERVER);
    }
}
