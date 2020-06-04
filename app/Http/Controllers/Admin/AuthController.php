<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = DB::table('node')->get();
        return view('Admin.Auth.index',['auth'=>$auth]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Auth.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Auth $request)
    {
        // dd($request->all());
        $data = $request->except(['_token']);
        $data['status'] = 0;
        // $name = $request->input('name');
        // $names = DB::table('node')->where('name','=',$name)->first();
        // dd($names);
        
        $res = DB::table('node')->insert($data);
        if($res){
            return redirect('/auth/create')->with('success','添加成功,继续添加');
        }else{
             return back()->with('error','添加失败,权限名重复');
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
        // echo $id;die;
       $info = DB::table('node')->where('id','=',$id)->first();
       // dd($info);
       return view('Admin.Auth.edit',['info'=>$info]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Auth $request, $id)
    {
        // dd($request->all());
        $data = $request->except(['_token','_method']);
        $res = DB::table('node')->where('id','=',$id)->update($data);
        if($res){
            return redirect('/auth')->with('success','修改成功');
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
        $res = DB::table('node')->where('id','=',$id)->delete();
        if($res){
            return redirect('/auth')->with('success','删除权限成功');
        }else{
            return back()->with('error','删除权限失败');
        }
    }
}
