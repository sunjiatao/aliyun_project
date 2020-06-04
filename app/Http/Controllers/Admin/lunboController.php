<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Config;
class lunboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('lunbo')->get();
        return view('Admin.lunbo.index',['data'=>$data]);
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
       $info = DB::table('lunbo')->where('id','=',$id)->first();
        return view('Admin.lunbo.edit',['info'=>$info]);
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
        // dd($request->all());
        
        $data=$request->except(['_token','_method']);
        if($request->hasFile('pic')){
             $name = time();
            // 获取上传文件后缀
            $ext = $request->file('pic')->getClientOriginalExtension();
            //移动文件位置
            $request->file('pic')->move('.'.Config::get('app.app_upload'),$name.".".$ext);
             // 追加图片路径
             $data['pic'] = Config::get('app.app_upload').'/'.$name.'.'.$ext;
            
             if(DB::table('lunbo')->where('id','=',$id)->update($data)){
                return redirect('/adminlunbo')->with('success','修改轮播图成功');
             }else{
                return back()->with('error','修改轮播图失败');
             }

        }else{
            return back()->with('error','请选择图片');
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
        //
    }

    
}
