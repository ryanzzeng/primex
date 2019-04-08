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
            'email' => ['required','unique:users'],
            'role_id' => ['required','exists:roles,id'],
            'created_by' => ['required','exists:users,username'],
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
            'email.unique' => 'Duplicate email is not allowed.',
            'role_id.exists' => 'Role is not existed.',
            'created_by.exists' => 'Invalid user operation.',
        ];
    }
}
