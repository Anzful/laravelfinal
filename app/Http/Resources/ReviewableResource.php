<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
     
    public function toArray($request)
    {
        if ($this->resource instanceof \App\Models\Book) {
            return [
                'type' => 'Book',
                'id' => $this->id,
                'title' => $this->title,
                // Add other Book-specific fields if needed
            ];
        } elseif ($this->resource instanceof \App\Models\Author) {
            return [
                'type' => 'Author',
                'id' => $this->id,
                'name' => $this->name,
                // Add other Author-specific fields if needed
            ];
        }

        return [];
    }
}
