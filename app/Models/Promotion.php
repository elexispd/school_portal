<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

     protected $fillable = [
        'student_id',
        'from_class_id',
        'from_class_arm_id',
        'to_class_id',
        'to_class_arm_id',
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function fromClass()
    {
        return $this->belongsTo(SchoolClass::class, 'from_class_id');
    }

    public function fromArm()
    {
        return $this->belongsTo(ClassArm::class, 'from_class_arm_id');
    }

    public function toClass()
    {
        return $this->belongsTo(SchoolClass::class, 'to_class_id');
    }

    public function toArm()
    {
        return $this->belongsTo(ClassArm::class, 'to_class_arm_id');
    }
}
