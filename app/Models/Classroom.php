<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $table = 'classrooms';
    public $incrementing = false;

    const LEVELGRADE = [
        'I' => 1,
        'II' => 2,
        'III' => 3,
        'IV' => 4,
        'V' => 5,
        'VI' => 6,
        'VII' => 7,
        'VIII' => 8,
        'IX' => 9,
        'X' => 10,
        'XI' => 11,
        'XII' => 12,
    ];

    protected $fillable = [
        'code',
        'name',
        'grade',
        'level',
        'capacity',
    ];

    public function students()
    {
        return $this->hasMany(Students::class);
    }
}
