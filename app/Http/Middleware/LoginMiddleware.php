<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       // 中间件做数据的过滤
        // 检测是否具有用户登录的session id
        if($request->session()->has('user_id')){
            //执行下一个请求
            return $next($request);

        }else{
            //跳转到登录界面
            return redirect('/login');
        }
    }
}
