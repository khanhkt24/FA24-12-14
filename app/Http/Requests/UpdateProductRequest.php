<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'cost' => 'required|numeric|min:1|max:100000000',
            'description' => 'nullable|string',
            'tag_id' => 'required|exists:tags,id',
            'category_id' => 'required|exists:categories,id',
            'img' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
