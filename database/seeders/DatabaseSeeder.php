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
use Database\Seeders\ClassroomSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(ClassroomSeeder::class);
        $this->call(UserSeeder::class);

        $selectedTeacherId = User::where('username', 'teacherlearnify123')->first()->id;

        $subjects = [
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'Bahasa Inggris',
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'Matematika',
            ],
        ];

        $subjectIds = [];
        foreach ($subjects as $subject) {
            $createdSubject = Subject::create($subject);
            $subjectIds[] = $createdSubject->id;

            SubjectTeacher::create(['subject_id' => $createdSubject->id, 'teachers' => [$selectedTeacherId], 'id' => Uuid::uuid4()->toString()]);
        }

        $babDescripton = collect([
            [
                'id' => Uuid::uuid4()->toString(),
                'description' => 'Pengenalan Bahasa Inggris',
                'grade' => rand(1, 12),
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'description' => 'Pengenalan Matematika',
                'grade' => rand(1, 12),
            ],
        ]);

        $courseIds = [];

        foreach ($subjectIds as $index => $subjectId) {
            if ($index === 0) {
                $course['description'] = 'Pengenalan Bahasa Inggris';
            } else {
                $course['description'] = 'Pengenalan Matematika';
            }

            $course['created_by'] = $selectedTeacherId;
            $course['subject_id'] = $subjectIds[$index];
            $course['id'] = Uuid::uuid4()->toString();
            $course['grade'] = rand(1, 12);
            $courseIds[] = Course::create($course)->id;
        }


        $order = 0;
        foreach ($subjectIds as $index => $subjectId) {
            $topic['course_id'] = $courseIds[$index];
            $topic['subject_id'] = $subjectId;
            $topic['name'] = "Pembahasan Bab {$order} {$subjects[$index]['name']}";
            $topic['order'] = $order;
            $topic['id'] = Uuid::uuid4()->toString();
            Topic::create($topic);
            $order++;
        }

        $this->call(SchedulesSeeder::class);
    }
}
