<?php

namespace App\Http\Requests\V1\User;

use App\Enums\PERMISSION;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != null && $user->tokenCan(PERMISSION::CREATE_USER->value);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'rol' => ['required', Rule::in('employee', 'superadmin')],
            'email' => ['required', 'email'],
            'address' => ['required'],
            "birth_date" => ['required'],
        ];
    }
}
