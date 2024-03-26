<?php

namespace App\Http\Requests\V1\File;

use App\Enums\PERMISSION;
use Illuminate\Foundation\Http\FormRequest;

class DownloadFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != null && $user->tokenCan(PERMISSION::DOWNLOAD_FILE->value);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required']
        ];
    }
}
