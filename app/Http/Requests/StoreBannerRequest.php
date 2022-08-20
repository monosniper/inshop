<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
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
            'shop_id' => ['sometimes', 'exists:shops,id'],
            'type' => ['sometimes'],
            'title' => ['sometimes'],
            'text' => ['sometimes'],
            'color' => ['sometimes'],
            'background' => ['sometimes'],
            'button_text' => ['sometimes'],
            'button_link' => ['sometimes'],
            'button_background' => ['sometimes'],
            'button_color' => ['sometimes'],
            'order' => ['sometimes'],
            'uuid' => ['sometimes', 'unique:banners'],
        ];
    }
}
