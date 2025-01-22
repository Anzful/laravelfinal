<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
     
    public function toArray($request)
    {
        return [
            'user' => [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                // Add other user fields as needed
            ],
            'profile' => [
                'id' => $this->profile->id ?? null,
                'bio' => $this->profile->bio ?? null,
                'created_at' => $this->profile->created_at->toIso8601String() ?? null,
                'updated_at' => $this->profile->updated_at->toIso8601String() ?? null,
            ],
        ];
    }
}
