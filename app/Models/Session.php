<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $table = 'course_sessions';

    protected $fillable = [
        'id',
        'course_id',
        'title',
        'scheduled_at',
        'duration_minutes'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
