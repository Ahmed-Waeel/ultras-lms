<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            "description"=>"required|min:20",
            "category"=>"required",
            "instructor"=>"required",
            "price"=>"required|numeric",
            "duration"=>"required|numeric",
        ];
    }

    public function messages()
    {
        return [
            "title.required"=>"Title can't be Empty",
            "title.string"=>"Please Enter a valid Title",
            "title.min"=>"Title must be at least 2 letters",
            "cover.mime"=>"Cover Photo Extension must be one of (pnj,jpg,jpeg)",
            "description.required"=>"Description can't be Empty",
            "description.min"=>"Description must be at least 20 letters",
            "category.required"=>"Please Select The Category",
            "instructor"=>"Please Select The Instructor",
            "price.required"=>"Price can't be empty",
            "price.numeric"=>"Please Enter a valid Price",
            "duration.required"=>"Duration can't be Empty",
            "duration.numeric"=>"Please Enter a valid Duration",
        ];
    }
}
