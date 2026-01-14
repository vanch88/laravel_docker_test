<?php

namespace App\Http\Requests;

class IndexDealRequest extends BaseFormRequest
{
    /**
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => [
                'required',
                'integer',
                'exists:products,id',
            ],
        ];
    }

    /**
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'product_id.required' => 'Параметр "product_id" обязателен для запроса.',
            'product_id.integer' => 'Параметр "product_id" должен быть числом.',
            'product_id.exists' => 'Указанный продукт не найден.',
        ];
    }
}
