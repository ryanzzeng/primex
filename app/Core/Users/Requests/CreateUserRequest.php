<?php

namespace App\Core\Users\Requests;

use App\Core\Base\BaseFormRequest;

class CreateUserRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'password' => ['required'],
            'email' => ['required','email','unique:users'],
            'role_id' => ['required','exists:roles,id'],
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'role_id.exists' => 'Role is not existed.',
        ];
    }
}
