<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'title' => ['required',],
            'shop_id' => ['required','exists:shops,id'],
            'category_id' => ['required','exists:categories,id'],
            'price' => ['required'],
            'uuid' => ['required'],
        ];
    }
}
