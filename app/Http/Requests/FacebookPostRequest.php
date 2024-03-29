<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacebookPostRequest extends FormRequest
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
            'tittle' => 'max:255',//|unique:facebook_posts',
            'date' => 'max:10',
            'url' => 'nullable|url',
            'active' => 'boolean',
            'content' => '', //required
        ];
    }
}
