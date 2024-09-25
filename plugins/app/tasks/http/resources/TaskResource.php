<?php namespace App\Tasks\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use LibUser\Userapi\Http\Resources\UserResource;

class TaskResource extends JsonResource {

    public function toArray($request) {
        return [
            "id" => $this->id,
            "project_id" => $this->project_id,
            "name" => $this->name,
            "user" => new UserResource($this->user),
            "is_completed" => $this->is_completed,
            "total_time" => $this->total_time
        ];
    }
    
}