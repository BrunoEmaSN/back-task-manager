<?php

namespace App\Http\Requests\V1\Task;

use App\Enums\PERMISSIONS;
use App\Enums\ROL;
use Illuminate\Foundation\Http\FormRequest;

class DeleteTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        if ($user == null) {
            return false;
        }
        $is_superadmin = $user->rol == ROL::SUPERADMIN->value;
        return $user->tokenCan(PERMISSIONS::DELETE_TASK->value) && $is_superadmin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required']
        ];
    }
}
