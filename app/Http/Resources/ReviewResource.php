<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'id' => $this->id,
            'content' => $this->content,
            'rating' => $this->rating,
            'reviewable_type' => class_basename($this->reviewable_type),
            'reviewable_id' => $this->reviewable_id,
            'reviewable' => $this->whenLoaded('reviewable', function () {
                return new ReviewableResource($this->reviewable);
            }),
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}
