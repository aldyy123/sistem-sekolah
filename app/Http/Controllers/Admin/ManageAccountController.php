<?php

namespace App\Http\Controllers\Admin;

use App\Exports\StudentExport;
use App\Exports\TeacherExport;
use App\Imports\StudentImport;
use App\Imports\TeacherImport;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Service\Database\ClassroomService;
use App\Service\Database\ExperienceService;
use App\Service\Database\StudentService;
use App\Service\Database\TeacherService;
use App\Service\Database\UserService;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class ManageAccountController extends Controller
{
    public function getAccount(Request $request)
    {
        $userDB = new UserService;

        $accounts = $userDB->index(['role' => $request->role]);

        return response()->json($accounts);
    }

    public function createAccount(Request $request)
    {
        $faker = Factory::create();
        $userDB = new UserService;
        $classroomService = new ClassroomService;
        $studentService = new StudentService;
        $teacherService = new TeacherService;
        $experienceDB = new ExperienceService;
        $username = strtolower(explode(' ', $request->name)[0] . $faker->numerify('####'));

        $payload = [
            'name' => $request->name,
            'username' => $username,
            'password' => $username,
            'role' => $request->role,
            'email' => $request->email,
            'status' => 1,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        $create = $userDB->create($payload);

        if ($request->role === 'STUDENT') {
            $codeClassroom = $classroomService->getClassroomByCode($request->grade);

            $studentPayload = [
                'nis'=> $request->nis,
                'batch_id' => $request->batch,
                'degree' => $request->degree,
                'classroom_id'=> $codeClassroom->id,
                'user_id' => $create->id,
                'last_education' => $request->last_education,
            ];
            $studentService->create($studentPayload);
            $experienceDB->create($create->id, ['grade' => Classroom::LEVELGRADE[$request->grade] ?? null, 'experience_point' => 0, 'level' => 0]);
        }


        if ($request->role === 'TEACHER') {
            $payload['nip'] = $request->nip;
            $payload['degree'] = $request->degree;
            $payload['last_education'] = $request->last_education;
            $payload['user_id'] = $create->id;

            $teacherService->create($payload);
        }

        return response()->json($create);
    }

    public function updateAccount(Request $request)
    {
        $userDB = new UserService;
        $studentService = new StudentService;
        $classroomService = new ClassroomService;
        $teacherService = new TeacherService;

        $responseJson = [];

        $payloadUser = [
            'name' => $request->name,
            'email' => $request->email,
            'status' => (int)$request->status,
        ];

        $update = $userDB->update($request->id, $payloadUser);
        $responseJson['user'] = $update;

        if ($request->role === 'STUDENT') {
            $classroom = $classroomService->getClassroomByCode($request->kelas);
            $updateData = [
                'nis' => $request->nis,
                'batch_id' => $request->batch,
                'degree' => $request->degree,
                'classroom_id' => $classroom->id,
            ];

            $studentService = $studentService->update($request->id, $updateData);
            $responseJson['student'] = $studentService;
        }

        if ($request->role === 'TEACHER') {
            $updateData = [
                'nip' => $request->nip,
                'degree' => $request->degree,
            ];

            $teacherService = $teacherService->update($request->id, $updateData);
            $responseJson['teacher'] = $teacherService;
        }

        return response()->json($responseJson, 200);
    }

    public function resetPassword(Request $request)
    {
        $userDB = new UserService;

        $payload = [
            'password' => $request->username,
        ];

        $update = $userDB->update($request->id, $payload);

        return response()->json($update);
    }

    public function updatePassword()
    {
        $userDB = new UserService;

        $currentPassword = Auth::user()->password;
        $oldPassword = request('old_password');

        if (HASH::check($oldPassword, $currentPassword)) {
            $userDB->update(
                Auth::user()->id,
                ['password' => request('password')]
            );

            return redirect()->back()->with('success', 'Berhasil memperbarui password');
        } else {
            return redirect()->back()->with('warning', 'Gagal memperbarui password');
        }
    }

    public function downloadExcelStudent()
    {
        $file = public_path() . "\assets\\excel\learnify_id_user_import_format_student.xlsx";
        $headers = array('Content-Type: application/xlsx',);
        return response()->download($file, 'learnify_id_user_import_format_student.xlsx', $headers);
    }

    public function downloadExcelTeacher()
    {
        $file = public_path() . "\assets\\excel\learnify_id_user_import_format_teacher.xlsx";
        $headers = array('Content-Type: application/xlsx',);
        return response()->download($file, 'learnify_id_user_import_format_teacher.xlsx', $headers);
    }

    public function importStudent(Request $request)
    {

        Excel::import(new StudentImport, $request->file('excel-file'));

        return redirect()->back();
    }

    public function importTeacher(Request $request)
    {

        Excel::import(new TeacherImport, $request->file('excel-file'));

        return redirect()->back();
    }

    public function exportStudent()
    {
        return Excel::download(new StudentExport, "student_account.xlsx");
    }

    public function exportTeacher()
    {
        return Excel::download(new TeacherExport, "teacher_account.xlsx");
    }
}
