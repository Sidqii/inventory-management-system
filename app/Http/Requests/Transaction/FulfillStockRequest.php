<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FulfillStockRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'items' => ['required', 'array', 'min:1'],

            'items.*.id' => [
                'required',
                'integer',
                'exists:stock_request_items,id',
            ],

            'items.*.quantity_issued' => [
                'required',
                'integer',
                'min:0',
            ],

            'items.*.note' => ['nullable', 'string'],
        ];
    }
}
