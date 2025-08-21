<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'subject_id',
        'term',
        'school_class_id',
        'class_arm_id',
        'ca',
        'ca2',
        'ca3',
        'ca4',
        'exam',
        'total',
        'grade',
        'class_lowest_score',
        'class_highest_score',
        'subject_avg_score',
        'position',
    ];

    protected $casts = [
        'total' => 'integer',
        'subject_avg_score' => 'decimal:2',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }





}
