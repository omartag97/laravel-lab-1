<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => "required|min:3 |unique:posts,title,$this->id",
            'body' => 'required|min:10',
            'title.required' => 'Title is required',
            'title.unique' => 'Title is already taken',
            'title.min' => 'Title must be at least 3 characters',
            'body.required' => 'Body is required',
            'body.min' => 'Body must be at least 10 characters',
        ];
    }
}
