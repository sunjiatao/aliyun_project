<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入db类
use DB;
use Config;

class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function index(Request $request)
    {
        //添加列表
        //获取搜索数据
        $k = $request -> input('keywords');

        $cates = DB::table('cates')->select(DB::raw("*,concat(path,',',id)as paths"))->orderBy('paths')->where('name','like','%'.$k.'%')->paginate(6);


        foreach($cates as $key=>$value){
            // echo $value->path."<br>";
            //把字符串转换为数组
            $arr=explode(",",$value->path);
            // var_dump($arr);
            //获取逗号个数
            $len=count($arr)-1;
            //重复字符串str_repeat
            $cates[$key]->name=str_repeat("--|",$len).$value->name;

        }
        return view('Admin.Cate.index',['cates'=>$cates,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加视图
        $cates = DB::table('cates')->where('path','like','_')->orWhere('path','like','___')->get();
        foreach($cates as $key=>$value){
            // echo $value->path."<br>";
            //把字符串转换为数组
            $arr=explode(",",$value->path);
            // var_dump($arr);
            //获取逗号个数
            $len=count($arr)-1;
            //重复字符串str_repeat
            $cates[$key]->name=str_repeat("--|",$len).$value->name;

        }
        // dd($cates);
        return view('Admin.Cate.add',['cates'=>$cates]);
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

        $pid = $request->input('pid');

        $data = $request->except(['_token']);
        //处理上传文件
        $res = $request -> hasFile('img');
        // dd($res);
        if($res != false && $pid <=0 ){
            //初始化名字
            $name = time();
            // 获取上传文件后缀
            $ext = $request->file('img')->getClientOriginalExtension();
            //移动文件位置
            $request->file('img')->move('.'.Config::get('app.app_upload'),$name.".".$ext);
             // 追加图片路径
             $data['img'] = Config::get('app.app_upload').'/'.$name.'.'.$ext;

        }else{
            $data['img'] = null;
        }
       
        // dd($data['img']);
        
        if($pid == 0){
            $data['path'] = 0;
        }else{
            $info = DB::table('cates')->where('id','=',$pid)->first();
            $data['path'] = $info->path.','.$info->id;
        }
        $row = DB::table('cates')->insert($data);
        if($row){
            return redirect('/admincates/create')->with('success','添加成功,继续添加');
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
       $info = DB::table('cates')->where('id','=',$id)->first();
       $cates = DB::table('cates')->where('path','like','_')->orWhere('path','like','___')->get();
       foreach($cates as $key=>$value){
            // echo $value->path."<br>";
            //把字符串转换为数组
            $arr=explode(",",$value->path);
            // var_dump($arr);
            //获取逗号个数
            $len=count($arr)-1;
            //重复字符串str_repeat
            $cates[$key]->name=str_repeat("--|",$len).$value->name;

        }
       return view('Admin.Cate.edit',['info'=>$info,'cates'=>$cates]);
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
        $data = $request->except(['_token','_method']);
        $pid = $request->input('pid');
         $res = $request -> hasFile('img');
        // dd($res);
        if($res != false && $pid <=0 ){
            //初始化名字
            $name = time();
            // 获取上传文件后缀
            $ext = $request->file('img')->getClientOriginalExtension();
            //移动文件位置
            $request->file('img')->move('.'.Config::get('app.app_upload'),$name.".".$ext);
             // 追加图片路径
             $data['img'] = Config::get('app.app_upload').'/'.$name.'.'.$ext;

        }else{
            $data['img'] = null;
        }


        
        if($pid == 0){
            $data['path'] = 0;
        }else{
            $info = DB::table('cates')->where('id','=',$pid)->first();
            $data['path'] = $info->path.','.$info->id;
        }

        $row = DB::table('cates')->where('id','=',$id)->update($data);
        if($row){
            return redirect('/admincates')->with('success','修改成功');
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
       
        $info = DB::table('cates')->where('pid','=',$id)->count();
        

        if($info>0){
            return back()->with('error','请先删掉子类');
        }
        $row = DB::table('cates')->where('id','=',$id)->delete();
        if($row){
            return redirect('/admincates')->with('success','删除成功');
        }else{
            return redirect('/admincates')->with('error','删除失败');
        }

    }
}
