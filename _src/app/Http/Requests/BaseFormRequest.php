<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class BaseFormRequest extends FormRequest
{
    /**
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        $failed = $validator->failed();
        $hasRequiredErrors = false;

        foreach ($failed as $field => $rules) {
            if (isset($rules['Required'])) {
                $hasRequiredErrors = true;
                break;
            }
        }

        $statusCode = $hasRequiredErrors ? 400 : 422;

        throw new HttpResponseException(
            response()->json([
                'status' => 'error',
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors(),
            ], $statusCode)
        );
    }
}
