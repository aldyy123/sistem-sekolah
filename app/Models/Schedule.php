<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Schedule extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'schedules';
    public $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'days',
        'time_start',
        'time_end',
        'subject_id',
        'classroom_id'
    ];

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function classroom(){
        return $this->belongsTo(Classroom::class, 'classroom_id', 'id');
    }
}
