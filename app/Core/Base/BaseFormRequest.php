<?php

namespace App\Core\Base;


use App\Core\Base\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseFormRequest extends FormRequest
{
    /**
     * Handle a failed authorization attempt.
     *
     * @param Validator $validator
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->getMessages();
        reset($errors);
        throw new ValidationException($validator,json_encode(['message' => $errors[key($errors)]]));
    }
}
