<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePhotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required'],
            'title'       => ['required', 'string', 'max:50'],
            'access'      => ['required', 'string', 'max:1'],
            'description' => ['nullable', 'string'],
            'image'       => ['required', 'image:jpg,jpeg,png,webp', 'max:20000']
        ];
    }
}
