<?php

namespace App\Http\Requests\V1\Comment;

use App\Enums\PERMISSIONS;
use App\Enums\ROL;
use Illuminate\Foundation\Http\FormRequest;

class DeleteCommentRequest extends FormRequest
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
        $is_owner = $user->id = $this->user_id;
        return $user->tokenCan(PERMISSIONS::DELETE_COMMENT->value) && ($is_superadmin || $is_owner);
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
