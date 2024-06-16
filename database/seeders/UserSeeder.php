<?php

namespace Database\Seeders;

use App\Models\Batchs;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = [
            [
                'name' => 'adminuser',
                'username' => 'adminlearnify123',
                'password' => Hash::make('adminlearnify123'),
                'role' => User::ADMIN,
                'status' => true,
                'phone' => '081234567890',
                'address' => 'Jl. Raya No. 1',
            ],
            [
                'name' => 'teacheruser',
                'username' => 'teacherlearnify123',
                'password' => Hash::make('teacherlearnify123'),
                'role' => User::TEACHER,
                'status' => true,
                'phone'=> '089765432100',
                'address' => 'Jl. Raya No. 2',
            ],
            [
                'name' => 'studentuser',
                'username' => 'studentlearnify123',
                'password' => Hash::make('studentlearnify123'),
                'role' => User::STUDENT,
                'status' => true,
                'phone' => '084534567890',
            ],
        ];

        foreach ($users as $user) {
            $createdUser = User::factory($user)->create();

            if ($createdUser->role === 'TEACHER') {
                DB::table('teachers')->insert([
                    'id' => Uuid::uuid4()->toString(),
                    'degree' => $faker->randomElement(['S1', 'S2', 'S3', 'D3']),
                    'last_education' => $faker->randomElement(['Universitas Indonesia', 'Universitas Gadjah Mada', 'Universitas Padjadjaran']),
                    'user_id' => $createdUser->id,
                ]);
            }

            if ($createdUser->role === 'STUDENT') {
                DB::table('students')->insert([
                    'id' => Uuid::uuid4()->toString(),
                    'user_id' => $createdUser->id,
                    'classroom_id' => Classroom::pluck('id')->random(),
                    'last_education' => 'SMPN 1 Bandung',
                    'degree' => $faker->randomElement(['SMP', 'MTS', 'SMA', 'MA']),
                    'batch_id' => Batchs::pluck('id')->random(),
                ]);

                DB::table('experiences')->insert([
                    'id' => Uuid::uuid4()->toString(),
                    'grade' => 12,
                    'user_id' => $createdUser->id,
                    'experience_point' => 0,
                    'level' => 0,
                ]);
            }
        }
    }
}
