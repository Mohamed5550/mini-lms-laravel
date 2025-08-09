<?php

namespace App\Http\Resources\Sessions;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'course_id' => $this->course_id,
            'title' => $this->title,
            'scheduled_at' => $this->scheduled_at,
            'duration_minutes' => $this->duration_minutes,
        ];
    }
}
