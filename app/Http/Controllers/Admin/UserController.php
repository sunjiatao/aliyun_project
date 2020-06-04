<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use App\Models\User;
// use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //列表
        // echo "会员列表";
        // 获取总条数
        $tot = User::count();
        // dd($tot);
        // 每页显示的数据条数
        $rev = 2;
        //获取最大页
        $maxPage = ceil($tot/$rev);
        // dd($maxPage);
        for($i=1;$i<=$maxPage;$i++){
            $pp[$i] = $i;
        }
        // dd($pp);
        //获取当前页

        $page = $request -> input('page');
        if(empty($page)){
            $page = 1;
        }
        //获取偏移量
        $offset = ($page-1)*$rev;
       // $sql = "select * from user limit $offset,$rev";
       $data = User::offset($offset)->limit($rev)->get();
        // ajax();判断请求方式
        if($request->ajax()){
           //加载Ajax独立模板
            return view('Admin.user.page',['data'=>$data]);
        }

        return view('Admin.user.index',['pp'=>$pp,'data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加
        // echo "会员添加";
        return view('Admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->except(['_token']);
        //密码加密
        $data['password'] = Hash::make($data['password']);
        $data['status'] = 1;
        //通过模型类插入数据
       if(User::create($data)){
            return redirect('/adminuser')->with('success','添加成功');
       }else{
             return redirect('/adminuser/create')->with('error','添加失败');
       }

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
       $user = User::where('id','=',$id)->first();
       return view('Admin.user.edit',['user'=>$user]);
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
        // echo $id;
        $data = $request->except('_token','_method');
        if(User::where('id','=',$id)->update($data)){
            return redirect('/adminuser')->with('success','修改成功');
        }else{
            return redirect('/adminuser/$id/edit')->with('error','修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(User::where('id','=',$id)->delete()){
            return redirect('/adminuser')->with('success','删除成功');
        }else{
            return redirect('/adminuser')->with('error','删除失败');
        }
    }
    // 获取会员详情信息
    public function userinfo($id){
        // echo $id;
        $info = User::find($id)->info;
        // dd($info);
        return view('Admin.user.info',['info'=>$info]);
    }
    // 收获地址
    public function useraddress($id){
        // echo $id;die;
        $address = User::find($id)->address;
        // dd($address);
        return view('Admin.user.address',['address'=>$address]);
        
    }
}
