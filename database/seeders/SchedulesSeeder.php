<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Database\Factories\ScheduleFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schedule::factory()->count(4)->create();
    }
}
