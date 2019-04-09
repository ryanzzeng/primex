<?php

namespace App\Core\Users\Requests;

use App\Core\Base\BaseFormRequest;

class UpdateUserRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            'user_id' => ['required','exists:users,id'],
            'role_id' => ['exists:roles,id'],
            'email' => ['email','unique:users,email'],
        ];
    }

    /**
     * Custom message for validation
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.exists' => 'Invalid user id',
            'role_id.exists' => 'Invalid role id',
            'email.email' => 'Invalid email',
        ];
    }
}
