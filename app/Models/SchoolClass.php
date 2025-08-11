<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClassArm;


class SchoolClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'category',
        'status'
    ];

    protected $casts = [
        'category' => 'string',
    ];

    // Constants for category
    const CATEGORY_JUNIOR = 'junior';
    const CATEGORY_SENIOR = 'senior';

    // Get all categories
    public static function getCategories()
    {
        return [
            self::CATEGORY_JUNIOR => 'Junior',
            self::CATEGORY_SENIOR => 'Senior'
        ];
    }

    // A class has many class arms
    public function classArms()
    {
        return $this->hasMany(ClassArm::class);
    }

    // A class has many students
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    // Get a specific student from this class
    public function getStudent($studentId)
    {
        return $this->students()->where('id', $studentId)->first();
    }

    public function scopeJunior($query)
    {
        return $query->where('category', 'junior');
    }

    public function scopeSenior($query)
    {
        return $query->where('category', 'senior');
    }




}
