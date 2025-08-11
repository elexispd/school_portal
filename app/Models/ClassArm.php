<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassArm extends Model
{
    use HasFactory;
    protected $fillable = ['school_class_id', 'name', 'status'];

    // Class arm belongs to a class
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    // A class arm has many students
    public function students()
    {
        return $this->hasMany(Student::class, 'classarm_id');
    }

    // Get a specific student from this arm
    public function getStudent($studentId)
    {
        return $this->students()->where('id', $studentId)->first();
    }


}
