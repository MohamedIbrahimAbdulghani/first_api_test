<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationAboutCreatePost extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'=>'required|min:3',
            'body'=>'required'
        ];
    }
    public function Messages()
    {
        return [
            'title.required'=>'Must Enter Title',
            'title.min'=>'Must Title Is Bigger Than 3 Letters',
            'body.required'=>'Must Enter Body'
        ];
    }
}