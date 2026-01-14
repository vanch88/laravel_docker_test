<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class StoreDealRequest extends BaseFormRequest
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
        return [
            'product_id' => [
                'required',
                'integer',
                'exists:products,id',
                Rule::unique('deals', 'product_id'),
            ],
            'client_name' => [
                'required',
                'string',
            ],
            'client_phone' => [
                'required',
                'string',
            ],
            'comment' => [
                'nullable',
                'string',
            ],
            'status' => [
                'nullable',
                'string',
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
            'product_id.required' => 'Поле "ID продукта" обязательно для заполнения.',
            'product_id.integer' => 'Поле "ID продукта" должно быть числом.',
            'product_id.exists' => 'Указанный продукт не найден.',
            'product_id.unique' => 'Для данного продукта уже существует сделка.',
            'client_name.required' => 'Поле "имя клиента" обязательно для заполнения.',
            'client_name.string' => 'Поле "имя клиента" должно быть строкой.',
            'client_phone.required' => 'Поле "телефон клиента" обязательно для заполнения.',
            'client_phone.string' => 'Поле "телефон клиента" должно быть строкой.',
            'comment.string' => 'Поле "комментарий" должно быть строкой.',
            'status.string' => 'Поле "статус" должно быть строкой.',
        ];
    }


    protected function prepareForValidation(): void
    {
        if (!$this->has('status')) {
            $this->merge(['status' => 'new']);
        }
    }

}
