<?php

// app/Services/AdmissionNumberService.php
namespace App\Services;

use App\Models\Student;
use Illuminate\Support\Str;

class AdmissionNumberService
{
    const PREFIX = 'EHS';

    public function generate(string $year): string
    {
        $sequence = $this->getNextSequenceNumber($year);
        return self::PREFIX . '/' . $year . '/' . Str::padLeft($sequence, 3, '0');
    }

    protected function getNextSequenceNumber(string $year): int
    {
        return Student::where('admission_year', $year)->count() + 1;
    }
}
