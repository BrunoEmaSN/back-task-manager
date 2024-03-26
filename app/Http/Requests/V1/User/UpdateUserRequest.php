<?php

namespace App\Http\Requests\V1\User;

use App\Enums\PERMISSION;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != null && $user->tokenCan(PERMISSION::UPDATE_USER->value);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if ($method == "PUT") {
            return [
                'name' => ['required'],
                'password' => ['sometimes'],
                'rol' => ['required', Rule::in('employee', 'superadmin')],
                'email' => ['required', 'email'],
                'address' => ['required'],
                "birth_date" => ['required', 'date_format:Y-m-d H:i:s']
            ];
        }

        return [
            'name' => ['sometimes', 'required'],
            'password' => ['sometimes'],
            'rol' => ['sometimes', 'required', Rule::in('employee', 'superadmin')],
            'email' => ['sometimes', 'required', 'email'],
            'address' => ['sometimes', 'required'],
            "birth_date" => ['sometimes', 'required', 'date_format:Y-m-d H:i:s']
        ];
    }
}
