<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EssayPost extends FormRequest
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
            'essay_name'=>[
                'required',
                Rule::unique('essay')->ignore(request()->id,'essay_id'),
                // 'unique:admin',
                'regex:/^[\x{4e00}-\x{9fa5}\w]{1,18}$/u',
            ],
            'e_id'=>'required',
        ];
    }
    public function messages(){
        return [ 
            'essay_name.required' => '文章标题必填', 
            'essay_name.unique' => '文章标题已存在', 
            'essay_name.regex'=>'文章标题由中文字母数字组成且不超过18位',
            'e_id.required'=>'文章分类必须选择',
        ]; 
    }
}
