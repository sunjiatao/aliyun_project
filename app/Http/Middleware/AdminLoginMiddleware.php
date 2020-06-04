<?php

namespace App\Http\Middleware;

use Closure;

class AdminLoginMiddleware
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
        //检测是否有session
        if($request->session()->has('adminname')){
            //把访问模块控制器和方法获取到,和权限列表做对比
            $nodelist=session('nodelist');

            $actions=explode('\\', \Route::current()->getActionName());
            //或$actions=explode('\\', \Route::currentRouteAction());
            $modelName=$actions[count($actions)-2]=='Controllers'?null:$actions[count($actions)-2];
            $func=explode('@', $actions[count($actions)-1]);
            $controllerName=$func[0];
            $actionName=$func[1];
            // echo $controllerName.':'.$actionName;
            //直接做对比
            //访问模块控制器不存在  访问模块控制器在但是方法不在
            if(empty($nodelist[$controllerName]) || !in_array($actionName,$nodelist[$controllerName])){
                return redirect('/admin')->with('error','sorry,您没有权限访问模块,请联系超级管理员');
            }
            return $next($request);
        }else{
            return redirect('/adminlogin/create');
        }
        
    }
}
