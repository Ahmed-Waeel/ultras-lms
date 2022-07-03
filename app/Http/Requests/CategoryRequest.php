<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            "title"=>"required|string|min:2",
            "cover"=>"nullable|mimes:jpeg,png,jpg|image|max:2048",
        ];
    }

    public function messages()
    {
        return [
            "title.required"=>"Title can't be Empty",
            "title.string"=>"Please Enter a valid Title",
            "title.min"=>"Title must be at least 2 letters",
            "cover.mime"=>"Cover Photo Extension must be one of (pnj,jpg,jpeg)",
            "cover.max"=>"The Cover Image Must be Less than 2 MB",
        ];
    }
}
