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
                'username' => 'adminLearnify123',
                'password' => Hash::make('adminLearnify123'),
                'role' => User::ADMIN,
                'status' => true,
                'phone' => '081234567890',
                'address' => 'Jl. Raya No. 1',
                'email' => 'admin@email.com',
                'id' => $faker->uuid()
            ],
            [
                'name' => 'teacheruser',
                'username' => 'teacherLearnify123',
                'password' => Hash::make('teacherLearnify123'),
                'role' => User::TEACHER,
                'status' => true,
                'phone' => '089765432100',
                'email' => 'teacher@email.com',
                'address' => 'Jl. Raya No. 2',
                'id' => $faker->uuid()
            ],
            [
                'name' => 'studentuser',
                'username' => 'studentLearnify123',
                'password' => Hash::make('studentLearnify123'),
                'role' => User::STUDENT,
                'status' => true,
                'email' => 'student@email.com',
                'phone' => '084534567890',
                'id' => $faker->uuid()
            ],
            [
                "username" => "anitaRahmawati",
                "name" => "Anita Rahmawati",
                "role" => User::TEACHER,
                "email" => "anita.rahmawati@gmail.com",
                "phone" => "081234567891",
                "address" => "Jl. Merdeka No. 15, Surabaya, Jawa Timur",
                "password" => Hash::make('anitaRahmawati'),
                "status" => true,
                "id" => $faker->uuid()
            ],
            [
                "username" => "budiSantoso",
                "name" => "Budi Santoso",
                "role" => User::TEACHER,
                "email" => "budi.santoso@gmail.com",
                "phone" => "081398765433",
                "address" => "Jl. Sudirman No. 25, Jakarta Selatan, DKI Jakarta",
                "password" => Hash::make('budiSantoso'),
                "status" => true,
                "id" => $faker->uuid()
            ],
            [
                "username" => "chandraWijaya",
                "name" => "Chandra Wijaya",
                "role" => User::TEACHER,
                "email" => "chandra.wijaya@gmail.com",
                "phone" => "081456781235",
                "address" => "Jl. Gajah Mada No. 40, Bandung, Jawa Barat",
                "password" => Hash::make('chandraWijaya'),
                "status" => true,
                "id" => $faker->uuid()
            ],
            [
                "username" => "ahmadFauzi",
                "name" => "Ahmad Fauzi",
                "role" => User::STUDENT,
                "email" => "ahmad.fauzi@gmail.com",
                "phone" => "082112345679",
                "address" => "Jl. Pahlawan No. 15, Slawi, Kabupaten Tegal",
                "password" => Hash::make('ahmadFauzi'),
                "status" => true,
                "id" => $faker->uuid()
            ],
            [
                "username" => "intanWulandari",
                "name" => "Intan Wulandari",
                "role" => User::STUDENT,
                "email" => "intan.wulandari@gmail.com",
                "phone" => "082223456780",
                "address" => "Jl. Diponegoro No. 30, Adiwerna, Kabupaten Tegal",
                "password" => Hash::make('intanWulandari'),
                "status" => true,
                "id" => $faker->uuid()
            ],
            [
                "username" => "budiSetiawan",
                "name" => "Budi Setiawan",
                "role" => User::STUDENT,
                "email" => "budi.setiawan@gmail.com",
                "phone" => "082334567891",
                "address" => "Jl. Ahmad Yani No. 40, Dukuhturi, Kabupaten Tegal",
                "password" => Hash::make('budiSetiawan'),
                "status" => true,
                "id" => $faker->uuid()
            ]
        ];

        foreach ($users as $user) {
            $createdUser = User::create($user);

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
                    'last_education' => $faker->randomElement(['SMP Negeri 1 Slawi', 'SMP Negeri 2 Slawi', 'SMP Negeri 3 Slawi']),
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
