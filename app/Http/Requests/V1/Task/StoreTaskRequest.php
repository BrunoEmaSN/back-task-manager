<?php

namespace App\Http\Requests\V1\Task;

use App\Enums\PERMISSION;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != null && $user->tokenCan(PERMISSION::CREATE_TASK->value);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "user_id" => ['required'],
            "title" => ["required"],
            "description" => ["sometimes", "nullable"],
            "status" => ["required", Rule::in("pending", "in_progress", "blocked", "done")],
            "start_date" => ["required", "date_format:Y-m-d H:i:s"],
            "end_date" => ["date_format:Y-m-d H:i:s", "nullable"],
        ];
    }
}
