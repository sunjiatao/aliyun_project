<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;

class AdminLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //退出
        $request->session()->pull('adminname');
        //加载登录界面
        return redirect('/adminlogin/create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载登录模板
        return view('Admin.Login.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $name = $request->input('name');
        
        $password = $request->input('password');
        $info = DB::table('admin_users')->where('name','=',$name)->first();
        if($info){
            // echo "name ok";
            if(Hash::check($password,$info->password)){
                //保存用户信息
                session(['adminname'=>$name]);
                //获取后台登录用户的所有权限信息
                $list = DB::select("select n.name,n.mname,n.aname from user_role as ur,role_node rn,node as n where ur.rid=rn.rid and rn.nid=n.id and uid={$info->id}");
                // dd($list);
                //初始化权限,追加后台首页权限
                $nodelist['AdminController'][]='index';
                foreach($list as $k=>$v){
                    $nodelist[$v->mname][]=$v->aname;
                    //如果有create 添加store
                    if($v->aname=='create'){
                         $nodelist[$v->mname][]='store';
                    }
                    //如果有edit方法 添加update
                    if($v->aname=='edit'){
                        $nodelist[$v->mname][]='update';
                    }
                }
                // dd($nodelist);
                //把当前登录用户的所有信息存储在session
                session(['nodelist'=>$nodelist]);
                
                return redirect('/admin')->with('success','欢迎'.session('adminname'));
            }else{
                return back()->with('error','密码不正确');
            }
        }else{
            return back()->with('error','管理员有误');
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
