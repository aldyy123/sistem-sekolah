<?php

namespace Database\Seeders;

use App\Models\Batchs;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

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
                'code' => 'A1',
                'name' => 'A1',
                'level' => 'XII',
                'capacity' => 30,
            ],
            [
                'code' => 'A2',
                'name' => 'A2',
                'level' => 'XII',
                'capacity' => 30,
            ],
            [
                'code' => 'A3',
                'name' => 'A3',
                'level' => 'XII',
                'capacity' => 30,
            ],
            [
                'code' => 'A4',
                'name' => 'A4',
                'level' => 'XII',
                'capacity' => 30,
            ],
            [
                'code' => 'A5',
                'name' => 'A5',
                'level' => 'XII',
                'capacity' => 30,
            ],
            [
                'code' => 'A6',
                'name' => 'A6',
                'level' => 'XII',
                'capacity' => 30,
            ],
            [
                'code' => 'A7',
                'name' => 'A7',
                'level' => 'XII',
                'capacity' => 30,
            ],
            [
                'code' => 'A8',
                'name' => 'A8',
                'level' => 'XII',
                'capacity' => 30,
            ],
            [
                'code' => 'A9',
                'name' => 'A9',
                'level' => 'XII',
                'capacity' => 30,
            ],
            [
                'code' => 'A10',
                'name' => 'A10',
                'level' => 'XII',
                'capacity' => 30,
            ],
        ];


        foreach ($classrooms as $classroom) {
            Classroom::create($classroom);
        }

        $users = [
            [
                'name' => 'adminuser',
                'username' => 'adminlearnify123',
                'password' => Hash::make('adminlearnify123'),
                'role' => User::ADMIN,
                'status' => true,
                'grade' => 12,
                'phone' => '081234567890',
                'address' => 'Jl. Raya No. 1',
                // 'school_id' => $schoolId,
            ],
            [
                'name' => 'teacheruser',
                'username' => 'teacherlearnify123',
                'password' => Hash::make('teacherlearnify123'),
                'role' => User::TEACHER,
                'status' => true,
                'grade' => 12,
                'phone'=> '089765432100',
                'address' => 'Jl. Raya No. 2',
                // 'school_id' => $schoolId,
            ],
            [
                'name' => 'studentuser',
                'username' => 'studentlearnify123',
                'password' => Hash::make('studentlearnify123'),
                'role' => User::STUDENT,
                'status' => true,
                'grade' => 12,
                'phone' => '084534567890',
                // 'school_id' => $schoolId,
            ],
            // // Add new teachers
            // ['name' => 'teacheruser2', 'username' => 'teacher2', 'password' => Hash::make('password2'), 'role' => User::TEACHER, 'status' => true, 'grade' => 12, 'school_id' => $schoolId],
            // ['name' => 'teacheruser3', 'username' => 'teacher3', 'password' => Hash::make('password3'), 'role' => User::TEACHER, 'status' => true, 'grade' => 12, 'school_id' => $schoolId],
            // ['name' => 'teacheruser4', 'username' => 'teacher4', 'password' => Hash::make('password4'), 'role' => User::TEACHER, 'status' => true, 'grade' => 12, 'school_id' => $schoolId],
            // ['name' => 'teacheruser5', 'username' => 'teacher5', 'password' => Hash::make('password5'), 'role' => User::TEACHER, 'status' => true, 'grade' => 12, 'school_id' => $schoolId],
            // ['name' => 'teacheruser6', 'username' => 'teacher6', 'password' => Hash::make('password6'), 'role' => User::TEACHER, 'status' => true, 'grade' => 12, 'school_id' => $schoolId],
            // // Add new students
            // ['name' => 'studentuser2', 'username' => 'student2', 'password' => Hash::make('password2'), 'role' => User::STUDENT, 'status' => true, 'grade' => 12, 'school_id' => $schoolId],
            // ['name' => 'studentuser3', 'username' => 'student3', 'password' => Hash::make('password3'), 'role' => User::STUDENT, 'status' => true, 'grade' => 12, 'school_id' => $schoolId],
            // ['name' => 'studentuser4', 'username' => 'student4', 'password' => Hash::make('password4'), 'role' => User::STUDENT, 'status' => true, 'grade' => 12, 'school_id' => $schoolId],
            // ['name' => 'studentuser5', 'username' => 'student5', 'password' => Hash::make('password5'), 'role' => User::STUDENT, 'status' => true, 'grade' => 12, 'school_id' => $schoolId],
            // ['name' => 'studentuser6', 'username' => 'student6', 'password' => Hash::make('password6'), 'role' => User::STUDENT, 'status' => true, 'grade' => 12, 'school_id' => $schoolId],
        ];

        $selectedTeacherId = '';
        foreach ($users as $user) {
            $createdUser = User::factory($user)->create();

            if ($createdUser->role === 'TEACHER') {
                $selectedTeacherId = $createdUser->id;
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
                    // 'school_id' => $schoolId,
                    'grade' => 12,
                    'user_id' => $createdUser->id,
                    'experience_point' => 0,
                    'level' => 0,
                ]);
            }
        }

        $subjects = [
            [
                'name' => 'Bahasa Indonesia',
                // 'school_id' => $schoolId,
            ],
            [
                'name' => 'Matematika',
                // 'school_id' => $schoolId,
            ],
            [
                'name' => 'Bahasa Sunda',
                // 'school_id' => $schoolId,
            ],
        ];

        $subjectIds = [];
        foreach ($subjects as $subject) {
            $createdSubject = Subject::factory($subject)->create();
            $subjectIds[] = $createdSubject->id;

            SubjectTeacher::factory(['subject_id' => $createdSubject->id, 'teachers' => [$selectedTeacherId]])->create();
        }

        $courseDescription = collect([
            'IT',
            'Bisnis',
            'Umum',
        ]);

        $courseIds = [];
        foreach ($subjectIds as $subjectId) {
            $course = [
                'description' => $courseDescription->random(),
                'grade' => 12,
                'created_by' => $selectedTeacherId,
                'subject_id' => $subjectId,
            ];

            $courseIds[] = Course::factory($course)->create()->id;
        }

        foreach ($subjectIds as $subjectId) {
            $course = [
                'description' => $courseDescription->random(),
                'grade' => 11,
                'created_by' => $selectedTeacherId,
                'subject_id' => $subjectId,
            ];

            $courseIds[] = Course::factory($course)->create()->id;
        }

        foreach ($subjectIds as $subjectId) {
            foreach ($courseIds as $courseId) {
                for ($i = 0; $i < 3; $i++) {
                    Topic::factory(['course_id' => $courseId, 'subject_id' => $subjectId])->create();
                }
            }
        }
    }
}
