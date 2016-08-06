<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreBlogRequest extends Request
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
            'title' => 'required|unique:blogs|min:5|max:255',
            'body'  => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'title.unique'   => 'A title already exist',
            'title.min'      => 'Too short title',
            'title.max'      => 'Too long title',
            'body.required'  => 'A message is required',
        ];
    }
}
