<?php namespace App\Projects\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use LibUser\Userapi\Http\Resources\UserResource;

class ProjectResource extends JsonResource {

    public function toArray($request) {
        return [
            "id" => $this->id,
            //"user" => new UserResource($this->user),
            "name" => $this->name,
        ];
    }
    
}