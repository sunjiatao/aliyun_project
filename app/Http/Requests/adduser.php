<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class adduser extends FormRequest
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
            //name 校验设置
            'name'=>'required|unique:admin_users',
        ];
    }

    public function messages(){
        return [
            'name.required'=>'名字不能为空',
            'name.unique'=>'该用户名已存在',
           
        ];
    }
}
