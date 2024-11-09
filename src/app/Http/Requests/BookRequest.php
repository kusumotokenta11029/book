<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class BookRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:50']
        ];
    }

    public function messages()
    {
        return
        [
            'title.required' => '本を入力してください',
            'title.string' => '本を文字列で入力してください',
            'title.max' => '本を50文字以下で入力してください',
        ];
    }
}
