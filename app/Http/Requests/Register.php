<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
             //密码规则
            'password'=>'required|regex:/\w{1,18}/',
            //确认密码 
            'repassword'=>'required|same:password',
           
        ];
    }
    public function messages(){
        return [
            'password.required'=>'密码不能为空',
            'password.regex'=>'密码必须是1-18位数字字母下划线',
            'repassword.required'=>'确认密码不能为空',
            'repassword.same'=>'两次密码不一致',
           
        ];
    }
}
