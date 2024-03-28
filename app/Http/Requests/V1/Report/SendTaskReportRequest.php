<?php

namespace App\Http\Requests\V1\Report;

use App\Enums\PERMISSIONS;
use App\Http\Requests\V1\Task\GetTasksRequest;

class SendTaskReportRequest extends GetTasksRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != null && $user->tokenCan(PERMISSIONS::SEND_REPORT->value);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required'],
            'title' => ['sometimes'],
            'user_id' => ['sometimes'],
            'status' => ['sometimes'],
            'start_date' => ['sometimes'],
            'end_date' => ['sometimes']
        ];
    }
}
