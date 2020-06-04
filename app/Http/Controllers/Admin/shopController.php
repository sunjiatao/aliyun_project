<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Markdown;

use App\Services\OSS;//阿里oss

class shopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $shops = DB::table('shops')->get();
        $shops = DB::table('shops')->select('cates.id as cid','cates.name as cname','shops.id as sid','shops.name as sname','shops.pic','shops.descr','shops.num','shops.price')->join('cates','shops.cate_id','=','cates.id')->get();
        return view('Admin.Shop.index',['info'=>$shops]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        return view('Admin.Shop.add',['cates'=>$cates]);
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
        if($request->hasFile('pic')){
            
            $file = $request->file('pic');
           
            $name = time();
            $ext=$request->file('pic')->getClientOriginalExtension();
            $newfile = $name.'.'.$ext;
            $filepath = $file->getRealPath();
            
            $res = OSS::upload($newfile,$filepath);
            $data['pic']=env('ALIURL').$newfile;
        }else{
            $data['pic'] = null;
        }
        $data['name']=$request->input('name');
        $data['cate_id']=$request->input('cate_id');
        //markdown 转换为html
        $data['descr']=Markdown::convertToHtml($request->input('descr'));
        $data['num']=$request->input('num');
        $data['price']=$request->input('price');
        // dd($data);
        if(DB::table('shops')->insert($data)){
            return redirect('/adminshop/create')->with('success','添加成功,继续添加');
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
        $data = DB::table('shops')->where('id','=',$id)->first();
        return view('Admin.Shop.edit',['data'=>$data,'cates'=>$cates]);
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
         if($request->hasFile('pic')){
            
            $file = $request->file('pic');
           
            $name = time();
            $ext=$request->file('pic')->getClientOriginalExtension();
            $newfile = $name.'.'.$ext;
            $filepath = $file->getRealPath();
            
            $res = OSS::upload($newfile,$filepath);
            $data['pic']=env('ALIURL').$newfile;
        }else{
           return back()->with('error','请选择商品图片');
        }
        $data['name']=$request->input('name');
        $data['cate_id']=$request->input('cate_id');
        $data['num']=$request->input('num');
        $data['price']=$request->input('price');
       
        $data['descr']=Markdown::convertToHtml($request->input('descr'));
       
        if (DB::table('shops')->where('id','=',$id)->update($data)) {
            return redirect('/adminshop')->with('success','修改成功');
        }
            return back()->with('error','修改失败');  
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
        if(DB::table('shops')->where('id','=',$id)->delete()){
            return redirect('/adminshop')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }

    }
}
