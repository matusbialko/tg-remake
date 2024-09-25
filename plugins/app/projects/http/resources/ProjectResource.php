<?php namespace App\Projects\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use LibUser\Userapi\Http\Resources\UserResource;

class ProjectResource extends JsonResource {

    public function toArray($request) {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "customer" => $this->customer,
            "project_manager" => $this->project_manager,
            "list" => $this->list,
            "user" => new UserResource($this->user),
            "is_closed" => $this->is_closed,
        ];
    }
    
}