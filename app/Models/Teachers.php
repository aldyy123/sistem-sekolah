<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'teachers';
    protected $typeKey = 'string';
    public $incrementing = false;

    protected $fillable = [
        'degree',
        'nip',
        'last_education',
        'user_id',
    ];

}
