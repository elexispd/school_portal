<?php

use Illuminate\Support\Facades\Route;

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

Route::view('dashboard', 'dashboard')
    ->name('dashboard');

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
Route::get('/classarms/by-class/{classId}', [App\Http\Controllers\ClassArmController::class, 'getByClass'])
    ->name('classarms.byClass');

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


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
