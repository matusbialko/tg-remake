<?php namespace App\Projects\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use LibUser\Userapi\Http\Resources\UserResource;

class ProjectResource extends JsonResource {

    public function toArray($request) {
        return [
            "id" => $this->id,
            "name" => $this->name,
            //"user" => new UserResource($this->user),
            "isClosed" => $this->isClosed,
        ];
    }
    
}