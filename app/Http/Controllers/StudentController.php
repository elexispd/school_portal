<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdmissionNumberService;

class StudentController extends Controller
{
    protected $admissionService;

    public function __construct(AdmissionNumberService $admissionService)
    {
        $this->admissionService = $admissionService;
    }

    public function store(Request $request)
    {
        $admissionNumber = $this->admissionService->generate();

        // ... rest of your logic
    }
}
