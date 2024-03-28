<?php

namespace App\Http\Resources\V1;

use App\Enums\STATUS;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\V1\UserResource;
use DateTime;

class ReportTaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'user' => new UserResource($this->whenLoaded('user')),
            'status' => $this->status,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'time_to_complete' => $this->time_to_complete(
                $this->status,
                $this->start_date,
                $this->end_date
            )
        ];
    }

    public function time_to_complete($status, $start_date, $end_date)
    {
        $start = new DateTime($start_date);
        $end = new DateTime($end_date);
        return $status == STATUS::DONE->value ? $start->diff($end)->format("%Y/%M/%D %H:%I:%S (Full days: %a)") : '-';
    }
}
