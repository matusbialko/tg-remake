<?php namespace App\Projects\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use LibUser\Userapi\Http\Resources\UserResource;

class ProjectResource extends JsonResource {

    public function toArray($request) {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "customer_id" => $this->customer_id,
            "project_manager_id" => $this->project_manager_id,
            "list" => $this->list,
            "user" => new UserResource($this->user),
            "is_closed" => $this->is_closed,
        ];
    }
    
}