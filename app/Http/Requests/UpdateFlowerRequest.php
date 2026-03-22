<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFlowerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:flowers,name,' . $this->route('flower')->id,
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|min:10',
            'price' => 'required|numeric|min:0.01',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'available' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'A flower with this name already exists.',
            'description.min' => 'Description must be at least 10 characters.',
            'price.min' => 'Price must be greater than zero.',
            'image.mimes' => 'Image must be a JPG, JPEG, PNG, or WebP file.',
        ];
    }
}
