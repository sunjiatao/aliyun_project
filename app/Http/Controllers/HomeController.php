<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function getCatesByid($pid){
        $cate = DB::table('cates')->where('pid','=',$pid)->get();
        $data = [];
        foreach($cate as $k=>$v){
            $v->suv = self::getCatesByid($v->id);
            $data[] = $v;
        }
        return $data;
    }
    
    public function index()
    {
        $cate = self::getCatesByid(0);
        //获取所有一级分类
        $cates=DB::table('cates')->where('path','like','___')->get();
        //遍历一级分类
        foreach($cates as $v){
            $shop[]=DB::table('shops')->join('cates','shops.cate_id','=','cates.id')->select('cates.name as cname','cates.id as cid','shops.name as sname','shops.id as sid','shops.price','shops.pic')->where('shops.cate_id','=',$v->id)->get();
        }
        $lunbo=DB::table('lunbo')->get();
        $gonggao=DB::table('articles')->get();
        // dd($shop);
        return view('Home.index',['cates'=>$cate,'shop'=>$shop,'lunbo'=>$lunbo,'data'=>$gonggao]);
        // return view('HomePublic.HomeIndex');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
        // echo $id;
        $shop=DB::table('shops')->where('id','=',$id)->first();
        return view('Home.home.introduction',['shop'=>$shop]);
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
    //搜索
    public function ss(Request $request)
    {
        // dd($request->all());
        $name=$request->input('name');
        $info = DB::table('shops_word')->where('word','=',$name)->first();
        if(!empty($info)){
            $keyword = DB::table('shops')->where('id','=',$info->id)->first();
            // dd($data);
            return view('Home.home.introduction',['shop'=>$keyword]);
        }else{
            return back()->with('shop11','暂时还没有该商品哦');
        }
    }

    //友情链接
    public function hezuo()
    {
        return view('Home.home.hezuo');
    }

    public function hezuo1(Request $request)
    {
       // dd($request->all());
       $data=$request->except(['_token']);
       $data['status']=0;
       
       if(DB::table('hezuo')->insert($data)){
            return back()->with('hezuo','申请成功,等待工作人员进行审核');
       }else{
            return back();
       }
    }
    //前台友情链接显示
    public function youqing()
    {
        $data=DB::table('hezuo')->where('status','=','2')->get();
        return view('Home.home.youqing',['data'=>$data]);
    }
    //前台公告
    public function gonggao($id)
    {
       $data = DB::table('articles')->where('id','=',$id)->first();
       // dd($data);
        return view('Home.home.gonggao',['data'=>$data]);
    }
}



