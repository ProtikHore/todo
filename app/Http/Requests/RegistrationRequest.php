<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'contact_no'=>'nullable|digits:11|unique:users,contact_no,' . $this->id,
            'email'=>'required|email|unique:users,email,' . $this->id,
            'password' => [
                function ($attribute, $value, $fail) {
                    if ($this->id) {
                        if ($value && $value !== $this->get('password_confirmation')) {
                            $fail(ucfirst($attribute) . ' and Confirm Password Mismatch!');
                        }
                    } else {
                        if ( ! $value) {
                            $fail(ucfirst($attribute) . ' Required!');
                        } elseif ($value !== $this->get('password_confirmation')) {
                            $fail(ucfirst($attribute) . ' and Confirm Password Mismatch!');
                        }
                    }
                }
            ],

        ];
    }
}
