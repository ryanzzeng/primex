<?php

namespace App\Core\Base;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

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
        throw new ValidationException($validator,new Response(json_encode(['message' => $errors[key($errors)]]), 422));
    }
}
