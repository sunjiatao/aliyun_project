<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取session
        $cart = session('cart');
        $data1=[];
        $tot='';
        $sum='';
        if(count($cart)){
            foreach($cart as $k=>$v){
                $info = DB::table('shops')->where('id','=',$v['id'])->first();
                $data['id']=$v['id'];
                $data['num']=$v['num'];
                $data['name']=$info->name;
                $data['price']=$info->price;
                $data['pic']=$info->pic;
                $data['descr']=$info->descr;
                $tot+=$data['price']*$data['num'];
                $sum+=$data['num'];
                $data1[]=$data;
             }
             // dd($data1);
        }
        
        //加载购物车的模板
        return view('Home.Cart.index',['data1'=>$data1,'tot'=>$tot,'sum'=>$sum]);
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


    //购物车去重复
    public function checkExists($id)
    {
        $cart = session('cart');
        if(empty($cart)){
            return false;
        }else{
            foreach($cart as $k=>$v){
                if($v['id'] == $id){
                    return true;
                }
            }
        }
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
        //把放入购物车的商品添加到session里
        $data = $request->except(['_token']);
        if(!$this->checkExists($data['id'])){
            $request->session()->push('cart',$data);
        }
        
        //跳转到购物车界面
        return redirect('/homecart');
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
        // echo $id;
        $cart = session('cart');
        // dd($cart);
        foreach($cart as $k=>$v){
            if($v['id']==$id){
                unset($cart[$k]);
            }
        }
        session(['cart'=>$cart]);
        return redirect('/homecart');
    }

    //购物车删除
    public function alldelete(Request $request)
    {
        $request->session()->pull('cart');
        return redirect('/homecart');
    }
    //购物车减
    public function cartupdate(Request $request)
    {
        $id = $request->input('id');
        $info = DB::table('shops')->where('id','=',$id)->first();

       $data = session('cart');
       // echo json_encode($data);die;
       foreach($data as $k=>$v){
            if($v['id']==$id){
                $data[$k]['num']-=1;
                if($data[$k]['num']<=1){
                    $data[$k]['num']=1;
                }
                session(['cart'=>$data]);
                
                $data1['num']=$data[$k]['num'];
                $data1['tot']=$data[$k]['num']*$info->price;
                echo json_encode($data1);

            }
       }
    }
    //购物车加
    public function cartupdate1(Request $request)
    {
        $id = $request->input('id');
        $info = DB::table('shops')->where('id','=',$id)->first();
        $data = session('cart');
        foreach($data as $k=>$v){
            if($v['id']==$id){
                $data[$k]['num']+=1;
                if($data[$k]['num']>=$info->num){
                    $data[$k]['num']=$info->num;
                }
                session(['cart'=>$data]);
                $data1['num']=$data[$k]['num'];
                $data1['tot']=$data[$k]['num']*$info->price;
                echo json_encode($data1);
            }
        }
    }
    //勾选购物车
    public function homecarttot(Request $request)
    {

        
        if(isset($_GET['arr'])){
            $sum=0;//总计
            $nums=0;//总件
            foreach($_GET['arr'] as $k=>$v){
                $data = session('cart');
                foreach($data as $key=>$value){
                    if($value['id']==$v){
                        //获取单价和数量
                        $num = $data[$key]['num'];
                        //获取商品数据
                        $info = DB::table('shops')->where('id','=',$v)->first();
                        $price=$info->price;
                        $tot = $num*$price;
                        $sum+=$tot;
                        $nums+=$num;
                    }
                }
            }
            $dataa['nums']=$nums;
            $dataa['sum']=$sum;
            echo json_encode($dataa); 
        }else{
            $dataa['nums']=0;
            $dataa['sum']=0;
            echo json_encode($dataa);  
        }
       
    }
    //
    public function bbb(Request $request){
        $data = $request->input('bbb');
        echo $data;
    }
   
}
