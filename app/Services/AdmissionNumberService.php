<?php

// app/Services/AdmissionNumberService.php
namespace App\Services;

use App\Models\Student;
use Illuminate\Support\Str;

class AdmissionNumberService
{
    const PREFIX = 'EHS';

    public function generate(): string
    {
        $currentYear = date('Y');
        $sequence = $this->getNextSequenceNumber($currentYear);

        return self::PREFIX . '/' . $currentYear . '/' . Str::padLeft($sequence, 3, '0');
    }

    protected function getNextSequenceNumber(string $year): int
    {
        return Student::whereYear('created_at', $year)->count() + 1;
    }
}
