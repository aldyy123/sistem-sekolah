<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\School;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $schoolId = School::factory(['name' => 'SMK Indonesia'])->create()->id;

        $users = [
            [
                'name' => 'adminuser',
                'username' => 'adminlearnify123',
                'password' => Hash::make('adminlearnify123'),
                'role' => User::ADMIN,
                'status' => true,
                'grade' => 12,
                'school_id' => $schoolId,
            ],
            [
                'name' => 'teacheruser',
                'username' => 'teacherlearnify123',
                'password' => Hash::make('teacherlearnify123'),
                'role' => User::TEACHER,
                'status' => true,
                'grade' => 12,
                'school_id' => $schoolId,
            ],
            [
                'name' => 'studentuser',
                'username' => 'studentlearnify123',
                'password' => Hash::make('studentlearnify123'),
                'role' => User::STUDENT,
                'status' => true,
                'grade' => 12,
                'school_id' => $schoolId,
            ],
            // Add new teachers
            ['name' => 'teacheruser2', 'username' => 'teacher2', 'password' => Hash::make('password2'), 'role' => User::TEACHER, 'status' => true, 'grade' => 12, 'school_id' => $schoolId],
            ['name' => 'teacheruser3', 'username' => 'teacher3', 'password' => Hash::make('password3'), 'role' => User::TEACHER, 'status' => true, 'grade' => 12, 'school_id' => $schoolId],
            ['name' => 'teacheruser4', 'username' => 'teacher4', 'password' => Hash::make('password4'), 'role' => User::TEACHER, 'status' => true, 'grade' => 12, 'school_id' => $schoolId],
            ['name' => 'teacheruser5', 'username' => 'teacher5', 'password' => Hash::make('password5'), 'role' => User::TEACHER, 'status' => true, 'grade' => 12, 'school_id' => $schoolId],
            ['name' => 'teacheruser6', 'username' => 'teacher6', 'password' => Hash::make('password6'), 'role' => User::TEACHER, 'status' => true, 'grade' => 12, 'school_id' => $schoolId],
            // Add new students
            ['name' => 'studentuser2', 'username' => 'student2', 'password' => Hash::make('password2'), 'role' => User::STUDENT, 'status' => true, 'grade' => 12, 'school_id' => $schoolId],
            ['name' => 'studentuser3', 'username' => 'student3', 'password' => Hash::make('password3'), 'role' => User::STUDENT, 'status' => true, 'grade' => 12, 'school_id' => $schoolId],
            ['name' => 'studentuser4', 'username' => 'student4', 'password' => Hash::make('password4'), 'role' => User::STUDENT, 'status' => true, 'grade' => 12, 'school_id' => $schoolId],
            ['name' => 'studentuser5', 'username' => 'student5', 'password' => Hash::make('password5'), 'role' => User::STUDENT, 'status' => true, 'grade' => 12, 'school_id' => $schoolId],
            ['name' => 'studentuser6', 'username' => 'student6', 'password' => Hash::make('password6'), 'role' => User::STUDENT, 'status' => true, 'grade' => 12, 'school_id' => $schoolId],
        ];

        $selectedTeacherId = '';
        foreach ($users as $user) {
            $createdUser = User::factory($user)->create();

            if ($createdUser->role === 'TEACHER') {
                $selectedTeacherId = $createdUser->id;
            }

            if ($createdUser->role === 'STUDENT') {
                DB::table('experiences')->insert([
                    'id' => Uuid::uuid4()->toString(),
                    'school_id' => $schoolId,
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
                'school_id' => $schoolId,
            ],
            [
                'name' => 'Matematika',
                'school_id' => $schoolId,
            ],
            [
                'name' => 'Bahasa Sunda',
                'school_id' => $schoolId,
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
        foreach($subjectIds as $subjectId) {
            $course = [
                'description' => $courseDescription->random(),
                'grade' => 12,
                'created_by' => $selectedTeacherId,
                'subject_id' => $subjectId,
            ];

            $courseIds[] = Course::factory($course)->create()->id;
        }

        foreach($subjectIds as $subjectId) {
            $course = [
                'description' => $courseDescription->random(),
                'grade' => 11,
                'created_by' => $selectedTeacherId,
                'subject_id' => $subjectId,
            ];

            $courseIds[] = Course::factory($course)->create()->id;
        }

        foreach($subjectIds as $subjectId) {
            foreach($courseIds as $courseId) {
                for($i = 0; $i < 3; $i++) {
                    Topic::factory(['course_id' => $courseId, 'subject_id' => $subjectId])->create();
                }
            }
        }




    }
}
