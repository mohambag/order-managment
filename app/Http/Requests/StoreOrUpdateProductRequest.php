<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrUpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // اگر احراز دسترسی خاصی نمی‌خوای، true بمونه
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ];
    }
}
