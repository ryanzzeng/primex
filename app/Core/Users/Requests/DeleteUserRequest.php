<?php

namespace App\Core\Users\Requests;

use App\Core\Base\BaseFormRequest;

class DeleteUserRequest extends BaseFormRequest
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
        $rules = [
            'user_ids' => ['required','array'],
            'user_ids.*' => ['required','exists:users,id']
        ];
        return $rules;
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_ids.required' => 'The :attribute field is missing.',
            'user_ids.*.exists' => 'The :attribute is invalid.'
        ];
    }
}
