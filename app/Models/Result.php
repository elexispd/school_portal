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
        'session_id',
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

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'school_class_id');
    }

    public function classArm()
    {
        return $this->belongsTo(ClassArm::class, 'class_arm_id');
    }

    public function term($term)
    {
        $terms = [
            1 => 'First Term',
            2 => 'Second Term',
            3 => 'Third Term',
        ];

        return $terms[$this->term] ?? 'Unknown Term';
    }

    // Returns the session name
    public function getSessionName()
    {
        return $this->session ? $this->session->name : 'Unknown Session';
    }

    // Returns the school class name
    public function getClassName()
    {
        return $this->schoolClass ? $this->schoolClass->name : 'Unknown Class';
    }

    // Returns the class arm name
    public function getClassArmName()
    {
        return $this->classArm ? $this->classArm->name : 'Unknown Class Arm';
    }

    public function getRemark($total) {
        if ($total >= 70) {
            return 'Excellent';
        } elseif ($total >= 60) {
            return 'Very Good';
        } elseif ($total >= 50) {
            return 'Good';
        } elseif ($total >= 45) {
            return 'Fair';
        } elseif ($total >= 40) {
            return 'Pass';
        } else {
            return 'Fail';
        }
    }

    public function ordinate($position) {
        $suffix = 'th'; // Default suffix
        // Handle exceptions for 1, 2, 3
        if ($position % 10 == 1 && $position != 11) {
            $suffix = 'st';
        } elseif ($position % 10 == 2 && $position != 12) {
            $suffix = 'nd';
        } elseif ($position % 10 == 3 && $position != 13) {
            $suffix = 'rd';
        }
        return $position . $suffix;
    }






}
