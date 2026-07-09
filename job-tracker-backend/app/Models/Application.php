<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    // Kolom yang diizinkan untuk diisi via API
    protected $fillable = [
        'user_id', 
        'company_name', 
        'position', 
        'work_type', 
        'salary_range', 
        'job_url', 
        'status', 
        'lexorank', 
        'notion_page_id', 
        'applied_at'
    ];

    // Relasi: Lamaran ini milik siapa?
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Lamaran ini punya jadwal wawancara apa saja?
    public function interviews()
    {
        return $this->hasMany(Interview::class);
    }
}
