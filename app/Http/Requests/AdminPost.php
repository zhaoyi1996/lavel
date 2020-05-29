<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdminPost extends FormRequest
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
        // dd(request()->id);
        return [
            'admin_name'=>[
                'required',
                Rule::unique('admin')->ignore(request()->id,'admin_id'),
                // 'unique:admin',
                'regex:/^[\x{4e00}-\x{9fa5}\w]{1,18}$/u',
            ],
            'admin_pwd'=>'required|regex:/^\w{6,12}$/|confirmed',
            'admin_tel'=>
            [
                'required',
                'regex:/^(133|153|180|181|189|130|131|132|155|156|185|186|134|159)\d{8}$/'
            ],
            'admin_email'=>'email',

        ];
    }
    public function messages(){
        return [ 
            'admin_name.required' => '管理员名称必填', 
            'admin_name.unique' => '管理员名称已存在', 
            'admin_name.regex'=>'管理员名称由中文字母数字组成且不超过18位',
            'admin_tel.required'=>'手机号必须填写',
            'admin_tel.regex'=>'手机号格式不正确',
            'admin_pwd.required'=>'密码不能为空',
            'admin_pwd.regex'=>'密码为6-12位',
            'admin_pwd.confirmed'=>'确认密码与密码不一致',
            'admin_email.email'=>'邮箱格式不正确',
            
            
        ]; 
    }
}
