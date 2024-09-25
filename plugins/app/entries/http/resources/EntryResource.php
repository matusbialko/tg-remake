<?php namespace App\Entries\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use LibUser\Userapi\Http\Resources\UserResource;

class EntryResource extends JsonResource {

    public function toArray($request) {
        return [
            "id" => $this->id,
            "task_id" => $this->task_id,
            "user" => new UserResource($this->user),
            "time_start" => $this->time_start,
            "time_end" => $this->time_end,
            "tracked_time" => $this->tracked_time,
            "is_active" => $this->is_active
        ];
    }
    
}