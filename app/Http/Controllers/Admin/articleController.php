<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\article;
use Config;
use Intervention\Image\ImageManager;
use App\Services\OSS;//阿里oss
use Illuminate\Support\Facades\Redis; //redis缓存
class articleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $arts = [];
        ///哈希表名
        $hashkey='Hash:php217article';
        //链表名
        $listkey='List:php217article';
        
        
       
            //判断redis里有没有缓存数据
            if(Redis::exists($listkey)){
                //获取缓存服务器的下的文章id
                $lists=Redis::lrange($listkey,0,-1);
                //遍历list 的id
                foreach($lists as $k=>$v){
                    $arts[]=Redis::hgetall($hashkey.$v);

                }
            }else{
                $arts = article::get()->toArray();
                //给redis
                foreach($arts as $k=>$v){
                    //将文章的id存储在list
                    Redis::rpush($listkey,$v['id']);
                    //将所有字段数据插入hash
                    Redis::hmset($hashkey.$v['id'],$v);
                }
            }
      
        // 
        return view('Admin.Article.index',['info'=>$arts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Admin.Article.add');
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
        // dd($request-all()); 
        //普通上传
        // if($request->hasFile('thumb')){

        //     $name = time();
        //     $ext = $request->file('thumb')->getClientOriginalExtension();
        //     //把文件移动到upload下
        //     $request->file('thumb')->move('.'.Config::get('app.app_upload1'),$name.'.'.$ext);
        //     //实例化类
        //     $manager = new ImageManager();
        //     //图片裁剪
        //     $manager->make('.'.Config::get('app.app_upload1').'/'.$name.'.'.$ext)->resize(50,50)->save('.'.Config::get('app.app_upload1').'/'.'r_'.$name.'.'.$ext);
        //      $data['thumb'] = Config::get('app.app_upload1').'/'.'r_'.$name.'.'.$ext;
        // }else{
        //     $data['thumb'] = null;
        // }
        // //数据入库
        // $data['title'] = $request->input('title');
        // $data['editor'] = $request->input('editor');
        //  $data['descr'] = $request->input('descr');
       
        // // dd($data);
        // $res = article::create($data);
        // if($res){
        //     return redirect('/article/create')->with('success','添加成功继续添加');
        // }else{
        //     return back()->with('error','添加失败');
        // }
/********************************************




***/
        //阿里云OSS图片存储
        if($request->hasFile('thumb')){
            //获取上传文件信息
            $file = $request->file('thumb');

            $name = time();
            $ext = $request->file('thumb')->getClientOriginalExtension();
            //把文件移动到upload下
            // $request->file('thumb')->move('.'.Config::get('app.app_upload1'),$name.'.'.$ext);
            //newfile上传到oss的名字  filepath上传文件临时目录
            $newfile = $name.'.'.$ext;
            $filepath = $file->getRealPath();
            $res = OSS::upload($newfile,$filepath);
            // die;
            //实例化类
            // $manager = new ImageManager();
            //图片裁剪
            // dd(env('ALIURL').$newfile);
            // $manager->make(env('ALIURL').$newfile)->resize(50,50)->save(Config::get('app.app_upload1').'/'.'r_'.$name.'.'.$ext);
             $data['thumb'] = env('ALIURL').$newfile;
        }else{
            $data['thumb'] = null; 
        }
        //数据入库
        $data['title'] = $request->input('title');
        $data['editor'] = $request->input('editor');
         $data['descr'] = $request->input('descr');
       
        // dd($data);
        $row = article::create($data);
        $id = $row->id;
        if($id){
            //把需要的数据插入到redis里
            //list//hash
            $hashkey='Hash:php217article';
            $listkey='List:php217article';
            Redis::rpush($listkey,$id);
            $data['id']=$id;
            Redis::hmset($hashkey.$id,$data);
            return redirect('/article/create')->with('success','添加成功继续添加');
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
    //ajax删除
    public function del(Request $request){
        // echo "string";
        $arr = $request->input('arr');
        // echo json_encode($arr);
        foreach($arr as $v){
            article::where('id','=',$v)->delete();
            //删除缓存数据
            $hashkey='Hash:php217article';
            $listkey='List:php217article';
            Redis::lrem($listkey,1,$v);
            Redis::del($hashkey.$v);
        }
        echo 1;

    }
}
