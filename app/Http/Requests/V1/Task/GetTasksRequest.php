<?php

namespace App\Http\Requests\V1\Task;

use App\Enums\PERMISSIONS;
use Illuminate\Foundation\Http\FormRequest;

class GetTasksRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != null && $user->tokenCan(PERMISSIONS::GET_TASKS->value);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['sometimes'],
            'user_id' => ['sometimes'],
            'status' => ['sometimes'],
            'start_date' => ['sometimes'],
            'end_date' => ['sometimes']
        ];
    }
}
