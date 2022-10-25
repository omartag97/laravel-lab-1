<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'user_id' => 'exists:users,id',
            'title' => [
                'required',
                'min:3',
                Rule::unique('posts')->ignore($this->post),
            ],
            'body' => 'required|min:10',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ];
    }
}
