<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取登录用户的个人信息，遍历到页面中
        $id = session("email");
        $data = DB::table("user")->where("email","=",$id)->first();
        //加载个人中心主页面
        return view("Home.Person.index",['data'=>$data]);
    }


    //前台个人中心的收货地址
    public function personaddress(){
        $id = session("homeid");
        $data = DB::table("address")->where("user_id","=",$id)->get();
        return view("Home.Person.address",['data'=>$data]);
    }


    // 前台个人中心的收货地址保存
    public function personaddressc(Request $request){
        $data['name'] = $request->input("name");
        $data['phone'] = $request->input("phone");
        $data['xhuo'] = $request->input("xhuo");
        $data['user_id'] = session("homeid");
        // echo $name;
        if(DB::table("address")->insert($data)){
            // return true;
            echo 1;
        }else{
            // return false;
            echo 2;
        }
    }

// where("user_id","=",$id)->where('status',"=",2)
    //前台个人中心的订单管理
    public function personorder(){
        $id = session("user_id");
        $data = DB::table("orders")->where("user_id","=",$id)->get();
        // $data1 = DB::table("orders")->join("order_goods","order_goods.order_id","=","orders.id")->join("shops","order_goods.goods_id","=","shops.id")->select("orders.id as oid","orders.order_num as onum","order_goods.id as ogid","order_goods.order_id as ogoid","order_goods.name as ogname","order_goods.num as ognum","order_goods.pic as ogpic","shops.id as sid","shops.name as sname","shops.pic as spic","shops.descr as descr","shops.num as snum","shops.price as sprice")->where("orders.user_id","=",$id)->get();
        // dd($data);
        $data1=[];
        foreach($data as $k=>$v){
            // dd($v->id);
            $info = DB::table('order_goods')->where('order_id','=',$v->id)->first();
           $data1[]=$info;

        }
         
        // dd($data1);
        return view("Home.Person.order",['data1'=>$data1,'data'=>$data]);
    }


    //前台个人中心的订单删除
    public function presonorderdel($id){
        // echo $id;
        // 先删除订单表中的数据
        if(DB::table("orders")->where("id","=",$id)->delete()){
            DB::table("order_goods")->where("order_id","=",$id)->delete();
            return redirect("/personorder")->with("asd","删除订单成功");
        }

    }

    //前台个人中心的确认收货
    public function presonorderupdate(Request $request,$id){
        // echo $id;
        $data['status'] = 6;
        if(DB::table("orders")->where("id","=",$id)->update($data)){
            return redirect("/personorder")->with("asd","确认收货成功");
        }
    }


    //前台个人中心的退款售后
    public function personchange(){
        $id = session("homeid");
        $data = DB::table("address")->where("user_id","=",$id)->get();
        return view("Home.Person.change",['data'=>$data]);
    }

    //前台个人中心评价商品
    public function personcomment(){
        $email = session("email");
        $info = DB::table('user')->where('email','=',$email)->first();
        $id = $info->id;
        $data1 = DB::table("orders")->join("order_goods","order_goods.order_id","=","orders.id")->join("shops","order_goods.goods_id","=","shops.id")->select("orders.id as oid","orders.order_num as onum","order_goods.id as ogid","order_goods.order_id as ogoid","order_goods.name as ogname","order_goods.num as ognum","order_goods.pic as ogpic","shops.id as sid","shops.name as sname","shops.pic as spic","shops.descr as descr","shops.num as snum","shops.price as sprice")->where("orders.user_id","=",$id)->where("orders.status","=",3)->get();
        return view("Home.Person.comment",['data'=>$data1]);
    }

    public function personcommentinsert(Request $request){
        // dd($request->all());
        $data['shop_id'] = $request->input("shop_id");
        $data['user_id'] = session("homeid");
        $data['pinglun'] = $request->input("pinglun");
        $data['status'] = $request->input("status");
        $oid = $request->input("order_id");
        if(DB::table("pinglun")->insert($data)){
            // DB::table("order_goods")->where("order_id","=",$oid)->where("goods_id","=",$data['shop_id'])->delete();
            return redirect("/personcomment")->with("qwe","评论成功");
        }else{
            return redirect("/personcomment")->with("qwe","评论失败");
        }
    }

    //个人中心的数据修改
    public function personindexinsert(Request $request){
        // dd($request->all());
        $id = $request->input("id");
        $token = $request->input("token");
        $user = DB::table("user")->where("id",$id)->first();
        if($user->token == $token){
            $data = $request->except("token","id","_token");
            $data['token'] = str_random(50);
            DB::table("user")->where("id","=",$id)->update($data);
            return redirect("/homeperson")->with("aaa","修改用户信息成功");
        }else{
            return redirect("/homeperson")->with("aaa","修改用户信息失败");
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
