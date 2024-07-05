<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\Database\BatchsService;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    private $batchsService;
    public function __construct(BatchsService $batchsService)
    {
        $this->batchsService = $batchsService;
    }

    public function index()
    {
        $batch = $this->batchsService->index();

        return view('admin.batchs', [
            'batchs' => $batch
        ]);
    }

    public function getBatchList(){
        $batch = $this->batchsService->index();

        return response()->json($batch);
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required',
            'start_periode' => 'required|before:end_periode',
            'end_periode' => 'required|after:start_periode',
            'status' => 'required',
            'cloter' => 'required',
        ]);

        $payload = $request->all();
        $this->batchsService->create($payload);

        // return redirect()->route('admin.batchs')->with('success', 'Batch created successfully');
        return response()->json(['message' => 'Batch created successfully']);
    }

    public function update(Request $request)
    {
        $request->validate([
            'batch_id' => 'required',
            'year' => 'required',
            'start_periode' => 'required|before:end_periode',
            'end_periode' => 'required|after:start_periode',
            'cloter' => 'required',
            'status' => 'required',
        ]);

        $payload = $request->all();
        $this->batchsService->update($payload['batch_id'], $payload, );

        return redirect()->route('admin.batchs')->with('success', 'Batch updated successfully');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'batch_id' => 'required',
        ]);

        $payload = $request->all();
        $this->batchsService->delete($payload['batch_id']);

        return redirect()->route('admin.batchs')->with('success', 'Batch deleted successfully');
    }
}
