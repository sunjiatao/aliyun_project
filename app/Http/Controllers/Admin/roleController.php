<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\Role;

class roleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = DB::table('role')->get();
        return view('Admin.Role.index',['role'=>$role]);
    }

    //分配权限
    public function adminauth($id){
        // echo $id;
        // 获取当前角色
        $info = DB::table('role')->where('id','=',$id)->first();
         //获取所有权限信息
        $auth = DB::table('node')->get();
        //获取当前角色权限信息
        $data = DB::table('role_node')->where('rid','=',$id)->get();
        if(count($data)){
            foreach($data as $v){
                $nids[] = $v->nid;
            }
            return view('Admin.Role.auth',['info'=>$info,'auth'=>$auth,'nids'=>$nids]);
        }else{
            return view('Admin.Role.auth',['info'=>$info,'auth'=>$auth,'nids'=>array()]);
        }
       
    }

    //保存权限
    public function saveauth(Request $request){
        // dd($request->all());
        $rid = $request->input('rid');
        //获取分配的权限
        $nids = $_POST['nids'];
        // dd($nids);
        // 删除当前角色之前角色信息
        DB::table('role_node')->where('rid','=',$rid)->delete();
        //入库
        foreach($nids as $k=>$v){
            $data['nid'] =$v;
            $data['rid'] = $rid;
            DB::table('role_node')->insert($data);
        }
        return redirect('/role')->with('success','权限分配成功');

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Role.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Role $request)
    {
        // dd($request->all());
        $data = $request->except(['_token']);
        $res = DB::table('role')->insert($data);
        if($res){
            return redirect('/role')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
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
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = DB::table('role')->where('id','=',$id)->first();
        return view('Admin.Role.edit',['info'=>$info]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Role $request, $id)
    {   
        // echo $id;die;
        // dd($request->all());
        $data = $request->except(['_token','_method']);
        $res = DB::table('role')->where('id','=',$id)->update($data);
        if($res){
            return redirect('/role')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
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
        // echo $id;
       $info =  DB::table('role')->where('id','=',$id)->first();
        if($info->name != '超管'){
            $res = DB::table('role')->where('id','=',$id)->delete();
             if($res){
                    DB::table('role_node')->where('rid','=',$id)->delete();
                    return redirect('/role')->with('success','删除角色成功');
                }else{
                    return back()->with('error','删除角色失败');
            }
         
        }else{
            return back()->with('error','超级管理员不能被删除');
        }
        
       
    }
}
