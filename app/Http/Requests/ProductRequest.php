<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'          => 'required',
            'category_id'   => 'required|numeric|exists:categories,id',
            'price'         => 'numeric',
            'image'         => 'nullable|image:jpeg,png,jpg,gif,svg,webp,avif|max:2048'
        ];
    }

}
