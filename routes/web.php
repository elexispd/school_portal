<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ResultController;
use App\Http\Controllers\ResumptionController;
use App\Http\Controllers\VacationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PromotionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::resource('classes', App\Http\Controllers\SchoolClassController::class)
        ->names([
            'index' => 'classes.index',
            'create' => 'classes.create',
            'store' => 'classes.store',
            'edit' => 'classes.edit',
            'update' => 'classes.update',
            'destroy' => 'classes.destroy'
        ]);
    Route::put('/classes/{class}/status', [App\Http\Controllers\SchoolClassController::class, 'updateStatus'])
        ->name('classes.updateStatus');

    Route::resource('class_arm', App\Http\Controllers\ClassArmController::class)
        ->names([
            'index' => 'classarms.index',
            'create' => 'classarms.create',
            'store' => 'classarms.store',
            'edit' => 'classarms.edit',
            'update' => 'classarms.update',
            'destroy' => 'classarms.destroy'
        ]);
    Route::put('/classarms/{class_arm}/status', [App\Http\Controllers\ClassArmController::class, 'updateStatus'])
        ->name('classarms.updateStatus');

    Route::resource('subjects', App\Http\Controllers\SubjectController::class)
        ->names([
            'index' => 'subjects.index',
            'create' => 'subjects.create',
            'store' => 'subjects.store',
            'edit' => 'subjects.edit',
            'update' => 'subjects.update',
            'destroy' => 'subjects.destroy'
        ]);
    Route::put('/subjects/{subject}/status', [App\Http\Controllers\SubjectController::class, 'updateStatus'])
        ->name('subjects.updateStatus');

    Route::resource('staff', App\Http\Controllers\StaffController::class)
        ->names([
            'index' => 'staff.index',
            'create' => 'staff.create',
            'store' => 'staff.store',
            'edit' => 'staff.edit',
            'update' => 'staff.update',
            'destroy' => 'staff.destroy'
        ]);

    Route::put('/staff/{staff}/status', [App\Http\Controllers\StaffController::class, 'updateStatus'])
        ->name('staff.updateStatus');

    Route::resource('sessions', App\Http\Controllers\SessionController::class)
        ->names([
            'index' => 'sessions.index',
            'create' => 'sessions.create',
            'store' => 'sessions.store',
            'edit' => 'sessions.edit',
            'update' => 'sessions.update',
            'destroy' => 'sessions.destroy'
        ]);
    Route::put('/sessions/{class}/status', [App\Http\Controllers\SessionController::class, 'updateStatus'])
        ->name('sessions.updateStatus');


    Route::get('/students/result', [App\Http\Controllers\StudentController::class, 'studentResult'])
        ->name('students.result');

    Route::get('/students/searchList', [App\Http\Controllers\StudentController::class, 'searchList'])
        ->name('students.list');
    Route::get('/students/studentList', [App\Http\Controllers\StudentController::class, 'studentListResult'])
        ->name('students.studentListResult');

    Route::resource('students', App\Http\Controllers\StudentController::class)
        ->names([
            'index' => 'students.search',
            'create' => 'students.create',
            'store' => 'students.store',
            'edit' => 'students.edit',
            'update' => 'students.update',
            'destroy' => 'students.destroy'
        ]);

    Route::put('/student/{student}/status', [App\Http\Controllers\StudentController::class, 'updateStatus'])
        ->name('students.updateStatus');


    Route::get('/results/upload', [ResultController::class, 'showUploadForm'])->name('results.upload');
    Route::post('/results/fetch-students', [ResultController::class, 'fetchStudents'])->name('results.fetch');
    Route::post('/results/store', [ResultController::class, 'store'])->name('results.store');

    // View results for a subject
    Route::get('/results/view', [ResultController::class, 'show'])->name('results.show');
    Route::post('/results/fetch-subject-results', [ResultController::class, 'fetchSubjects'])->name('results.fetch.subject');
    Route::get('/results/{result}/edit', [ResultController::class, 'edit'])->name('results.edit');
    Route::put('/results/{result}', [ResultController::class, 'update'])->name('results.update');
    Route::delete('/results/{result}', [ResultController::class, 'destroy'])->name('results.destroy');

    Route::get('/results/mastersheet', [ResultController::class, 'mastersheet'])->name('results.mastersheet.show');
    Route::post('/results/getMastersheet', [ResultController::class, 'getMastersheet'])->name('results.fetch.mastersheet');
    Route::post('/results/print', [ResultController::class, 'print'])->name('results.print');


    Route::get('/resumptions', [ResumptionController::class, 'create'])->name('resumptions.create');
    Route::post('/resumptions', [ResumptionController::class, 'store'])->name('resumptions.store');

    Route::get('/vacations', [VacationController::class, 'create'])->name('vacations.create');
    Route::post('/vacations', [VacationController::class, 'store'])->name('vacations.store');

    Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.search');
    Route::get('/promotions/result', [PromotionController::class, 'studentResult'])
        ->name('promotions.result');
   Route::post('/promotions/promote', [PromotionController::class, 'promoteStudents'])->name('promotions.promote');


    Route::view('profile', 'profile')
        ->middleware(['auth'])
        ->name('profile');

});

Route::get('/classarms/by-class/{classId}', [App\Http\Controllers\ClassArmController::class, 'getByClass'])
    ->name('classarms.byClass');

Route::get('/check-result', [ResultController::class, 'index'])->name('results.index');
Route::post('/check-result', [ResultController::class, 'checkResult'])->name('results.check');


require __DIR__.'/auth.php';
