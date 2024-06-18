<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Schedule;
use App\Service\Database\ClassroomService;
use App\Service\Database\SchedulesService;
use App\Service\Database\SubjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageSchedule extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->query();
        $schedules = new SchedulesService;
        $classrooms = new ClassroomService;
        $subjects = new SubjectService;

        $listClassroom = $classrooms->index([
            'order_by' => 'asc'
        ]);

        $classroom_id = $query['classroom_id'] ?? $listClassroom['data'][0]['id'];

        $list = $schedules->index([
            'classroom_id' => $classroom_id,
        ]);

        $listClassroom = $classrooms->index([
            'order_by' => 'asc'
        ]);

        $mapel = $subjects->index();


        return view('admin.schedule', [
            'schedulesArray' => ['data' => $list],
            'classrooms' => $listClassroom,
            'query' => $classroom_id,
            'mapel' => $mapel
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $schedules = new SchedulesService;

        $data = $schedules->filled(new Schedule, $request->all());
        $data = $schedules->create($data);

        return response()->json([
            'status' => 'Success Created Schedule',
            'data' => $data
        ], 200);

   }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $schedules = new SchedulesService;
        $scheduleExist = $schedules->getById($id);

        if (!$scheduleExist) {
            return redirect()->back()->with('status', 'Schedule Not Found');
        }

        $schedules->delete($scheduleExist);

        return redirect()->back()->with('status', 'Success Deleted Schedule');
    }
}
