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

    public function store(Request $request)
    {
        $payload = $request->all();
        $this->batchsService->create($payload);

        return redirect()->route('admin.batchs')->with('success', 'Batch created successfully');
    }
}
