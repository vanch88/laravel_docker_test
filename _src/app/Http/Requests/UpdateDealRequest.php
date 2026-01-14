<?php

namespace App\Http\Requests;

class UpdateDealRequest extends BaseFormRequest
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
            'status' => [
                'nullable',
                'string',
            ],
            'comment' => [
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
            'status.string' => 'Поле "статус" должно быть строкой.',
            'comment.string' => 'Поле "комментарий" должно быть строкой.',
        ];
    }
}
