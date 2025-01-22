<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'content' => $this->faker->sentence,
            'rating' => $this->faker->numberBetween(1,5),
            // We'll set reviewable_id, reviewable_type when creating
        ];
    }
}
