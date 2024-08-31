<?php namespace App\Entries\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use LibUser\Userapi\Http\Resources\UserResource;

class EntryResource extends JsonResource {

    public function toArray($request) {
        return [
            "id" => $this->id,
            //"user" => new UserResource($this->user),
            "time_from" => $this->time_from,
            "time_to" => $this->time_to,
        ];
    }
    
}