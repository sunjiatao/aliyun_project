<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Config;
use Hash;
use App\Http\Requests\adduser;
class AdminusersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $k = $request->input('keywords');
        $info = DB::table('admin_users')->where('name','like','%'.$k.'%')->paginate(2);

        return view('Admin.Users.index',['info'=>$info,'request'=>$request->all()]);

    }

    //分配角色
    public function adminuserrole($id)
    {
        // echo $id;
        // 获取用户信息
        $info = DB::table('admin_users')->where('id','=',$id)->first();
        // 获取所有角色信息
        $role = DB::table('role')->get();
        // 获取当前用户角色信息
        $data = DB::table('user_role')->where('uid','=',$id)->get();
        // 加载分配角色模板
        if(count($data)){
            foreach($data as $v){
                 $rids[] = $v->rid;
            }
            return view('Admin.Users.role',['info'=>$info,'role'=>$role,'rids'=>$rids]);
        }else{
            return view('Admin.Users.role',['info'=>$info,'role'=>$role,'rids'=>array()]); 
        }
        
    }
    //保存角色
    public function saverole(Request $request, $id)
    {
        // echo $id;die;
        // dd($request->all());
        $data['uid'] = $request->input('uid'); 
        $data['rid'] = $request->input('rids'); 
       
        $res = DB::table('user_role')->where('uid','=',$id)->update($data);
        if($res){
            return redirect('/adminusers')->with('success','修改角色成功');
        }else{
            return back()->with('error','该用户还是当前角色,请选择其他角色');
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
        return view('Admin.Users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(adduser $request)
    {
        // dd($request->all());
        $data = $request->except(['_token']);

        //判断密码是否一致
        $password = $request->input('password');
        $repassword = $request->input('repassword');
        if($password == $repassword){
            $data = $request->except(['_token','repassword']);
            $data['password'] = Hash::make($password);

        }else{
            $request->flashOnly('name');
            return back()->with('error','密码不一致');
        }


         //处理上传文件
        $res = $request -> hasFile('uface');
        // dd($res);
        if($res != false ){
            //初始化名字
            $name = time();
            // 获取上传文件后缀
            $ext = $request->file('uface')->getClientOriginalExtension();
            //移动文件位置
            $request->file('uface')->move('.'.Config::get('app.uface'),$name.".".$ext);
             // 追加图片路径
             $data['uface'] = Config::get('app.uface').'/'.$name.'.'.$ext;

        }else{
            $data['uface'] = '/upload/2019-07-25/15640214970.jpg';
        }
        // dd($data);

        $res = DB::table('admin_users')->insert($data);
        // dd($data);
       if($res){
             $info =  DB::table('admin_users')->where('name','=',$data['name'])->first();
       // dd($info);
             $data1 = [];
             $data1['uid'] = $info->id;
             $data1['rid'] = 1;
             // dd($data1);
             DB::table('user_role')->insert($data1);
            return redirect('/adminusers/create')->with('success','添加成功继续添加');
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
        $info = DB::table('admin_users')->where('id','=',$id)->first();
        return view('Admin.Users.edit',['info'=>$info]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(adduser $request, $id)
    {
        // $aa = $request->all();
        // dd($aa);
        $data = $request->except(['_token','_method']);

        $res = $request -> hasFile('uface');
        // dd($res);
        if($res != false ){
            //初始化名字
            $name = time();
            // 获取上传文件后缀
            $ext = $request->file('uface')->getClientOriginalExtension();
            //移动文件位置
            $request->file('uface')->move('.'.Config::get('app.uface'),$name.".".$ext);
             // 追加图片路径
             $data['uface'] = Config::get('app.uface').'/'.$name.'.'.$ext;

        }
        $res = DB::table('admin_users')->where('id','=',$id)->update($data);
        if($res){
            return redirect('/adminusers')->with('success','修改成功');
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
        $res = DB::table('admin_users')->where('id','=',$id)->delete();
        
        if($res){
             DB::table('user_role')->where('uid','=',$id)->delete();
            return redirect('/adminusers')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
}
