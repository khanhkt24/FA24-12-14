<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBientheRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'size' => 'required|string|max:50|regex:/^[\pL0-9\s]+$/u',
            'color' => 'required|string|max:50|regex:/^[\pL\s]+$/u',
            'quantity' => 'required|integer|min:1',
        ];
    }
}
