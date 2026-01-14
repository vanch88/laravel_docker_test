<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateProductRequest extends BaseFormRequest
{

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
        $productId = $this->route('product');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'name')->ignore($productId),
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
            'name.required' => 'Поле "название" обязательно для заполнения.',
            'name.string' => 'Поле "название" должно быть строкой.',
            'name.max' => 'Поле "название" не может быть длиннее 255 символов.',
            'name.unique' => 'Продукт с таким названием уже существует.',
        ];
    }

}
