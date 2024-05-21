<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $table = 'classrooms';
    public $incrementing = false;

    protected $fillable = [
        'code',
        'name',
        'level',
        'capacity',
    ];

    public function students()
    {
        return $this->hasMany(Students::class);
    }
}
