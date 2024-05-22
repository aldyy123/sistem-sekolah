<?php

namespace App\Service\Database;

use App\Models\Batchs;
use Ramsey\Uuid\Uuid;

class BatchsService {
    public function index($filter = [])
    {
        $orderBy = $filter['order_by'] ?? 'DESC';
        $per_page = $filter['per_page'] ?? 99;
        $status = $filter['status'] ?? null;

        $query = Batchs::orderBy('created_at', $orderBy);

        if ($status !== null) {
            $query->where('status', $status);
        }

        $batchs = $query->simplePaginate($per_page);

        return $batchs->toArray();
    }

    public function detail($batchId)
    {
        $batch = Batchs::findOrFail($batchId);

        return $batch->toArray();
    }

    public function create($payload)
    {
        $batch = new Batchs;
        $batch->id = Uuid::uuid4()->toString();
        $batch = $this->fill($batch, $payload);
        $batch->save();

        return $batch->toArray();
    }

    public function update($batchId, $payload)
    {
        $batch = Batchs::findOrFail($batchId);
        $batch = $this->fill($batch, $payload);
        $batch->save();

        return $batch->toArray();
    }

    public function delete($batchId)
    {
        $batch = Batchs::findOrFail($batchId);
        $batch->delete();

        return $batch->toArray();
    }

    private function fill($batch, $payload)
    {
        $batch->start_periode = $payload['start_periode'] ?? $batch->start_periode;
        $batch->end_periode = $payload['end_periode'] ?? $batch->end_periode;
        $batch->year = $payload['year'] ?? $batch->year;
        $batch->status = $payload['status'] ?? $batch->status;

        return $batch;
    }
}
