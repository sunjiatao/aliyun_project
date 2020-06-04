<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\User;//导入user模型类;
use Hash;
use Mail;

class HomeLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Home.HomeLogin.login');
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
        $email = $request->input('email');
        $password = $request->input('password');
        
        
        //检测$email
        $info = User::where('email','=',$email)->first();
        // dd($info);
        if($info){
            //检测密码
            if(Hash::check($password,$info->password)){
                //检测状态
                if($info->status == '激活'){
                    session(['user_id'=>$info->id]);
                    session(['email'=>$email]);
                    return redirect('/index');

                }else{
                    return back()->with('error','该邮箱还未激活');
                }
            }else{
                return back()->with('error','密码错误');
            }
            
        }else{
            return back()->with('error','邮箱有误');
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
    //
    //
    //发送邮件找回密码
    public function loginMail($id,$email,$token)
    {
         Mail::send('Home.HomeLogin.reset',['id'=>$id,'token'=>$token],function($message)use($email){
            $message->to($email);
            $message->subject('【重置密码】');
        });
         return true;
    }
    //加载忘记密码模板
    public function forget()
    {
        return view('Home.HomeLogin.forget');
    }
    //获取邮箱找回密码
    public function doforget(Request $request){
        $email = $request->input('email');
        $info = User::where('email','=',$email)->first();
        if($this->loginMail($info->id,$email,$info->token)){
            return '请登陆邮箱进行验证';
        }
    } 
    
    //加载密码重置模板
    public function reset(Request $request)
    {
        $id = $request->input('id');
        $token = $request->input('token');
        // echo $id .'---'.$token;
        $info = User::where('id','=',$id)->first();
        if($token == $info->token){
            return view('Home.HomeLogin.reset1',['id'=>$id]);
        }
    }
    //密码修改
    public function doreset(Request $request)
    {
        $id = $request->input('id');
        $password = $request->input('password');
        $data['password'] = Hash::make($password);
        $data['token'] = str_random(30);
        if(User::where('id','=',$id)->update($data)){
            return redirect('/homelogin/create');
        }
    }
    //退出
    public function homeloginout(Request $request)
    {
        $request->session()->pull('email');
        $request->session()->pull('goods');
        $request->session()->pull('cart');
        return redirect('/index');
    }
}

