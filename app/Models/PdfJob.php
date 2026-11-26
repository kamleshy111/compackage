<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'user_id',
        'total_employees',
        'processed_employees',
        'status',
        'file_path',
        'error_message'
    ];

    protected $casts = [
        'total_employees' => 'integer',
        'processed_employees' => 'integer',
    ];
}