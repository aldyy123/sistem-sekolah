<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'degree',
        'nis',
        'last_education',
        'user_id',
        'batch_id',
        'classroom_id',
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batchs::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
