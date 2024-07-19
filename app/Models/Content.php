<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    public $incrementing = false;

    const PUBLISHED = 'PUBLISHED';
    const DRAFT = 'DRAFT';

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function contentResults()
    {
        return $this->hasMany(ContentResult::class, 'content_id');
    }


}
