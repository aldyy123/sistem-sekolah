<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'days' => fake()->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']),
            'time_start' => fake()->time(),
            'time_end' => fake()->time(),
            'subject_id' => Subject::pluck('id')->random(),
            'classroom_id' => Classroom::pluck('id')->random(),
        ];
    }
}
