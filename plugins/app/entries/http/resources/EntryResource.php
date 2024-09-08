<?php namespace App\Entries\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use LibUser\Userapi\Http\Resources\UserResource;

class EntryResource extends JsonResource {

    public function toArray($request) {
        return [
            "id" => $this->id,
            //"user" => new UserResource($this->user),
            "task_id" => $this->task_id,
            "time_start" => $this->time_start,
            "time_end" => $this->time_end,
            "isActive" => $this->isActive
        ];
    }
    
}