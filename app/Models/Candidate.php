<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'job_id', 
        'status', 
        'resume_path', // <-- ΠΡΟΣΤΕΘΗΚΕ ΕΔΩ!
        'ai_score',    
        'ai_analysis', 
        'notes'
    ];

    // Σχέση: Ο υποψήφιος ανήκει σε μια αγγελία
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}