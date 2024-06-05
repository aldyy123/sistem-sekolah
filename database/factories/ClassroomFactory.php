<?php

namespace Database\Factories;

use App\Models\Batchs;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->word(),
            'name' => $this->faker->word(),
            'level' => $this->faker->word(),
            'capacity' => $this->faker->numberBetween(10, 50),
            'student_count' => 0,
            'batch_id' => Batchs::pluck('id')->random(),
        ];
    }
}
