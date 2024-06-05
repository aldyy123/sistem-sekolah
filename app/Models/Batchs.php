<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batchs extends Model
{
    use HasFactory;

    protected $table = 'batchs';
    public $incrementing = false;
}
