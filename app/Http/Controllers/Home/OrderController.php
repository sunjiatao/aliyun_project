<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

//把获取到的数据放在session里当做商品
    public function jiesuan(Request $request)
    {
        $arr = $_GET['arr'];
        $data=array();
        foreach($arr as $k=>$v){
            $cart=session('cart');
            foreach($cart as $key=>$value){
                if($v==$value['id']){
                    $data[$key]['num']=$cart[$key]['num'];
                    $data[$key]['id']=$v;
                }
            }
        }

        $request->session()->push('goods',$data);
        echo json_encode($data);
    }
    public function insert()
    {
        // echo "string";
        // dd(session('goods'));
        $goods=session('goods');
        // dd($goods);
        $d=[];
        $tot='';
        foreach($goods as $k=>$v){
            //获取商品数据
            // dd($v);
            foreach($v as $kk=>$vv){
                $shop=DB::table('shops')->where('id','=',$vv['id'])->first();
                $temp['num']=$vv['num'];
                $temp['pic']=$shop->pic;
                $temp['name']=$shop->name;
                $temp['price']=$shop->price;
                $tot+=$vv['num']*$shop->price;
                $d[]=$temp;
            }
            
        }
        //获取收获地址
        $address = self::alladdress();
        $addressfirst = DB::table('address')->where('user_id','=',session('user_id'))->first();
        // dd($d);
        return view('Home.Order.index',['d'=>$d,'tot'=>$tot,'address'=>$address,'addressfirst'=>$addressfirst]);
    }

    //获取城市级联
    public function address(Request $request)
    {   
        $data['name']=$request->input('name');
        $data['phone']=$request->input('phone');
        $data['xhuo']=$request->input('xhuo');
        $data['user_id']=session('user_id');
        if(DB::table('address')->insert($data)){
            return back();
        }
    }

    //获取当前用户所有收货地址
    public static function alladdress()
    {
        $address=DB::table('address')->where('user_id','=',session('user_id'))->get();
        return $address;
    }
    public function index()
    {
        
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
        echo 666;
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

    //开始支付
    public function homeordercreate(Request $request)
    {
        // dd($request->all());
        $data=$request->except(['_token']);
        $data['order_num']=time().rand(1000,9999);//订单号
        $data['user_id']=session('user_id');
        $data['status']=0; //0表示已经下单未付款
        $id = DB::table('orders')->insertGetId($data);//添加的同时拿到id
        if($id){
            //订单详情表入库
           $goods = session('goods');
           $d=[];
           $tot='';

           foreach($goods as $key =>$value){
                //获取商品数据
                foreach($value as $k=>$v){
                    //获取商品详情
                    $info = DB::table('shops')->where('id','=',$v['id'])->first();
                    // dd($v['num']);
                    $data1['order_id']=$id;
                    $data1['goods_id']=$v['id'];
                    $data1['name']=$info->name;
                    $data1['num']=$v['num'];
                    $data1['pic']=$info->pic;
                    $tot+=$data1['num']*$info->price;
                    $d[]=$data1;

                }
                if(DB::table('order_goods')->insert($d)){
                    session(['order_id'=>$id]);
                    session(['address_id'=>$data['address_id']]);
                    session(['tot'=>$tot]);
                    //订单号
                    $out_trade_no=$data['order_num'];
                    //主题
                    $subject='支付';
                    //支付金额
                    $total_fee=0.01;
                    //
                    $body='shop pay';
                    pays($out_trade_no,$subject,$total_fee,$body);
                }
           }
        }
    }

    //支付完成跳转路由
    public function returnurl(Request $request){
        $order_id=session('order_id');
        $address_id=session('address_id');
        $tot=session('tot');
        $data['status']=2;//已付款
        DB::table('orders')->where('id','=',$order_id)->update($data);
        //获取选择的收获地址
        $address=DB::table('address')->where('id','=',$address_id)->first();

         //清除购物车 结算页session
         $request->session()->pull('cart');
        

        $request->session('cart');
        $request->session()->pull('goods');
        return view('Home.pay.index',['address'=>$address,'tot'=>$tot]);
         
       
    }
}
