<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    protected $fillable = [
        'application_id', 'interview_type', 'scheduled_at', 'meeting_link'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
