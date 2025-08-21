<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'admission_number', 'admission_year', 'first_name', 'middle_name', 'last_name',
        'school_class_id', 'class_arm', 'date_of_birth', 'gender', 'religion', 'address',
        'state_of_origin', 'lga', 'phone', 'passport_photo', 'result_pin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function class()
    {
        return $this->belongsTo(SchoolClass::class);
    }
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    function classArm()
    {
        return $this->belongsTo(ClassArm::class, 'class_arm');
    }

    // In the Student model (Student.php)

    public function results()
    {
        return $this->hasMany(Result::class);
    }


    // public function guardians()
    // {
    //     return $this->belongsToMany(Guardian::class)
    //         ->withPivot('is_primary')
    //         ->withTimestamps();
    // }

    // public function results()
    // {
    //     return $this->hasMany(Result::class);
    // }

    // public function masterResults()
    // {
    //     return $this->hasMany(MasterResult::class);
    // }

    // Helper method to get full name
    public function getFullNameAttribute()
    {
        return "{$this->last_name} {$this->first_name}" .
               ($this->middle_name ? " {$this->middle_name}" : '');
    }

    // Generate a unique result PIN
    public static function generateResultPin()
    {
        do {
            $pin = strtoupper(Str::random(2)) . rand(10, 99) . Str::random(2);
        } while (self::where('result_pin', $pin)->exists());

        return $pin;
    }
}
