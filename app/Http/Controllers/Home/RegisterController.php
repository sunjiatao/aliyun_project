<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;//发送邮件功能
use Gregwar\Captcha\CaptchaBuilder;//导入验证码类
use App\Models\HomeRegister; //导入模型类
use Hash;
// use App\Http\Requests\Register;

class RegisterController extends Controller
{

     //邮件测试路由
    public function sendmail()
    {
        //raw 发送原始字符串函数   $message消息生成器 to 接收方用户名
        //cc 抄送给谁  bcc(不抄送给谁) subject(邮件主题)
        Mail::raw('中奖了',function($message){
            $message->to('1902291251@qq.com');
            $message->subject('测试邮件');
        });
    }

    //发送试图
    public function sendmail1()
    {
        Mail::send('Home.Register.a',['id'=>100],function($message){
            $message->to('1902291251@qq.com');
            $message->subject('【京东快递】');
        });
    }
   
    //测试验证码
    public function code()
    {
        ob_clean();//清除操作
        //实例化验证码类
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100,$height = 40,$font = null);
        //获取验证码的内容
        $phrase = $builder -> getPhrase();
        // 方便把输入校验码做对比
        session(['vcode'=>$phrase]);
        //生成图片
        header("Cache-Control: no-cache,must-revalidate");
        header('Content-Type: image/jpeg');
        //输出验证码
        $builder->output();
        // die;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $email = $request->input("email");
        $email1 = HomeRegister::where('email','=',$email)->first();
        if($email1 != null && $email1['status']==2){
            echo "邮箱已存在";
            
        }else if($email1 != null && $email1['status']==1){
            echo "2";
        }else if(empty($email)){
            echo "1";
        }else{
            echo '';
        }
        
        
        // echo $email;
        // echo "string";
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Home.Register.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //发送邮件激活用户
    public function registerMail($id,$email,$token){
         Mail::send('Home.Register.jihuo',['id'=>$id,'token'=>$token],function($message)use($email){
            $message->to($email);
            $message->subject('【用户激活】');
        });
         return true;
    }
    public function store(Request $request)
    {
       //  dd($request->all());
       //  $email = $request->input('email');
       // $email1 = HomeRegister::where('email','=',$email)->first(); 
       // $email2 = json_encode($email);
       // dd($email1);
       //  //
        // dd($request->all());
        //获取输入校验码
        $code = $request->input('code');
        //获取系统的验证码
        $vcode = session('vcode');
        // echo $code.":".$vcode;
        if($code == $vcode){
            // dd($request->all());
            $data['email'] = $request->input('email');
            $data['password']=Hash::make($request->input('password'));
            $data['name'] = 'ndaaf'.rand(1,10000000);
            $data['status'] = 0;//0没有激活
            $data['token'] = str_random(30);
            $data['phone'] = '';
            //入库
            $data1 = HomeRegister::create($data);
            $id = $data1->id;
            
            if($id){
               $res = $this->registerMail($id,$data['email'],$data['token']);
               if($res){
                    echo "激活用户的邮件已经发送,请登陆邮箱(如果长时间未收到邮件通知,请去邮件垃圾箱查看)";
               }else{
                    return back()->with('error','系统错误');
               }
            }else{
                echo "error";
            }

        }else{
            return back()->with('error','验证码有误');
        }
    }

     //激活用户
    public function jihuo(Request $request)
    {
        // dd($request->all());
        $id = $request->input('id');
        $token = $request->input('token');

        // 获取数据库的token
        $user = HomeRegister::where('id','=',$id)->first();
        if($token == $user->token){
            $data['status'] = 2;
            $data['token'] = str_random(30);
            HomeRegister::where('id','=',$id)->update($data);
            echo "用户已经激活,"."<a href='http://39.101.137.78/homelogin/create'>请登录</a>";
            
        }
        // echo $id;
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
    //手机号注册
    public function registerphone(Request $request)
    {
        
        // dd($request->all());
        $data['name'] = 'asdfjl'.rand(1,10000000);
        $data['email'] = '';

        $data['password'] = Hash::make($request->input('password'));
        $data['status'] = 2;
        $data['phone'] = $request->input('phone');
        $data['token'] = str_random(30);
        // dd($data);
        $res = HomeRegister::create($data);
        if($res){
            return redirect('/homelogin/create');
        }else{
            return back();
        }


    }
    //检测手机号是否唯一
    public function checkphone(Request $request)
    {
        $p = $request->input('p');
        // echo $p;
        //和数据表手机号做对比
        $phone = HomeRegister::pluck('phone')->toArray();
        // dd($phone);
        if(in_array($p,$phone)){
            echo 1;
        }else{
            echo 0;
        }
    }
    //发送短信校验码
    public function registersendphone(Request $request){
        $pp = $request->input('pp');
        // echo 000000;
        // //调用短信接口
        $data = sendsphone($pp);

        echo $data;

    }
    //检测校验吗
    public function checkcode(Request $request)
    {
        // dd($request->all());
        $code = $request->input('code');
        //和系统校验码做对比
         if($_COOKIE['pcode'] && !empty($code)){
            $pcode = $request->cookie('pcode');
            if($code == $pcode){
                echo 1; //校验码ok
            }else{
                echo 2; //校验码有误
            }
         }else if(empty($code)){
            echo 3;//校验码位空
         }else{
            echo 4;// 校验码过期
         }
    }
}
