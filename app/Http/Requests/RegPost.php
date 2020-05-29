<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegPost extends FormRequest
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
            'user_pwd'=>[
                'required',
                'regex:/^[0-9a-zA-Z]{6,18}$/u',
            ],
        ];
    }
    public function messages(){
        return [ 
            'user_pwd.required' => '密码不能为空',  
            'user_pwd.regex'=>'密码由数字、字母组成，最少6位，最多18位',
        ]; 
    }
}
