<?php

namespace App\Http\Requests\V1\Comment;

use App\Enums\PERMISSION;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
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

        $is_owner = $user->id == $this->user_id;
        $has_access = $user->tokenCan(PERMISSION::UPDATE_COMMENT->value);

        return $has_access && $is_owner;
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
                "comment" => ["required"],
                "user_id" => ["required"],
                "task_id" => ["required"]
            ];
        }

        return [
            "comment" => ["sometimes", "required"],
            "user_id" => ["sometimes", "required"],
            "task_id" => ["sometimes", "required"]
        ];
    }
}
