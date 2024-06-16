<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $batchs = [
            [
                'start_periode' => 'January',
                'end_periode' => 'June',
                'year' => '2021',
                'status' => 'active',
            ],
            [
                'start_periode' => 'July',
                'end_periode' => 'December',
                'year' => '2021',
                'status' => 'active',
            ]
        ];

        foreach ($batchs as $batch) {
            DB::table('batchs')->insert($batch);
        }


        $classrooms = [
            [
                'code' => 'I',
                'grade' => Classroom::LEVELGRADE['I'],
                'level' => 'SD',
                'capacity' => 30,
            ],
            [
                'code'=> 'II',
                'level'=> 'SD',
                'grade' => Classroom::LEVELGRADE['II'],
                'capacity'=> 40,
            ],
            [
                'code' => 'III',
                'level'=> 'SD',
                'grade' => Classroom::LEVELGRADE['III'],
                'capacity'=> 50,
            ],
            [
                'code' => 'IV',
                'level'=> 'SD',
                'grade' => Classroom::LEVELGRADE['IV'],
                'capacity'=> 60,
            ],
            [
                'code' => 'V',
                'level'=> 'SD',
                'grade' => Classroom::LEVELGRADE['V'],
                'capacity'=> 70,
            ],
            [
                'code' => 'VI',
                'level'=> 'SD',
                'grade' => Classroom::LEVELGRADE['VI'],
                'capacity'=> 80,
            ],
            [
                'code' => 'VII',
                'level'=> 'SMP',
                'grade' => Classroom::LEVELGRADE['VII'],
                'capacity'=> 90,
            ],
            [
                'code' => 'VIII',
                'level'=> 'SMP',
                'grade' => Classroom::LEVELGRADE['VIII'],
                'capacity'=> 100,
            ],
            [
                'code' => 'IX',
                'level'=> 'SMP',
                'grade' => Classroom::LEVELGRADE['IX'],
                'capacity'=> 110,
            ],
            [
                'code' => 'X',
                'level'=> 'SMA',
                'grade' => Classroom::LEVELGRADE['X'],
                'capacity'=> 120,
            ],
            [
                'code' => 'XI',
                'level'=> 'SMA',
                'grade' => Classroom::LEVELGRADE['XI'],
                'capacity'=> 130,
            ],
            [
                'code' => 'XII',
                'level'=> 'SMA',
                'grade' => Classroom::LEVELGRADE['XII'],
                'capacity'=> 140,
            ],
        ];


        foreach ($classrooms as $classroom) {
            Classroom::create($classroom);
        }
    }
}
