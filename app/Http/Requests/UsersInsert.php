<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersInsert extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // 给表单校验请求类授权
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //规则  required 字段不能为空
            'username'=>'required|regex:/\w{3,8}/|unique:users',
            //密码规则
            'password'=>'required|regex:/\w{1,18}/',
            //确认密码 
            'repassword'=>'required|same:password',
            //邮箱规则
            'email'=>'required|email|unique:users',
            //电话规则
            'phone'=>'required|unique:users|regex:/\d{11}/',
        ];
    }

    //自定义错误提示
    public function messages(){
        return [
            //显示自定义错误消息
            'username.required'=>'名字不能为空',
            'username.regex'=>'名字必须是5-8位数字字母下划线',
            'username.unique'=>'名字不能重复',
            'password.required'=>'密码不能为空',
            'password.regex'=>'密码必须是1-18位数字字母下划线',
            'repassword.required'=>'确认密码不能为空',
            'repassword.same'=>'两次密码不一致',
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱格式不正确',
            'email.unique'=>'邮箱不能重复',
            'phone.required'=>'电话不能为空',
            'phone.regex'=>'电话格式不正确 ',
            'phone.unique'=>'电话不能重复',
        ];
    }
}
