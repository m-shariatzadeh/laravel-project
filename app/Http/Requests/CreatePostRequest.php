<?php

namespace App\Http\Requests;

use App\Rules\Uppercase;
use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            'caption'     => ['required','max:50' /*, new Uppercase()*/ ],
            'description' => 'required',
            'image'       => ['required','max:1000','mimes:jpg,png,jpeg']
        ];
    }

    public function messages()
    {
        return [
            'caption.required'     => 'لطفا عنوان را وارد نمایید.',
            'caption.max'          => 'عنوان باید حداکثر 5 کاراکتر وارد نمایید',
            'description.required' => 'لطفا توضیحات را وارد نمایید',
            'image.required'       => 'لطفا یک عکس را انتخاب کنید',
            'image.max'            => 'عکس باید حداکثر یک مگ باشد',
            'image.mimes'          => 'لطفا یک عکس با فرمت jpg,png,jpeg انتخاب نمایید'
        ];
    }
}
