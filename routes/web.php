<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

Route::get('admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');


// User Management All Routes
Route::prefix('users')->group(function(){
    Route::get('/view', [UserController::class, 'UserView'])->name('users.view');
    Route::get('/create', [UserController::class, 'UserCreate'])->name('users.create');
    Route::post('/store', [UserController::class, 'UserStore'])->name('users.store');
    Route::get('/edit/{id}', [UserController::class, 'UserEdit'])->name('users.edit');
    Route::post('/update/{id}', [UserController::class, 'UserUpdate'])->name('users.update');
    Route::get('/delete/{id}', [UserController::class, 'UserDelete'])->name('users.delete');
});
// Setups Class Management All Routes
Route::prefix('setups')->group(function(){

    // Student Class Management All Routes
    Route::get('student/class/view', [StudentClassController::class, 'ViewStudent'])->name('student.class.view');
    Route::get('student/class/create', [StudentClassController::class, 'StudentClassCreate'])->name('student.class.create');
    Route::post('student/class/store', [StudentClassController::class, 'StudentClassStore'])->name('student.class.store');
    Route::get('student/class/edit/{id}', [StudentClassController::class, 'StudentClassEdit'])->name('student.class.edit');
    Route::post('student/class/update/{id}', [StudentClassController::class, 'StudentClassUpdate'])->name('student.class.update');
    Route::get('student/class/delete/{id}', [StudentClassController::class, 'StudentClassDelete'])->name('student.class.delete');

    // Student Year Management All Routes
    Route::get('student/year/view', [StudentYearController::class, 'ViewStudentYear'])->name('student.year.view');
    Route::get('student/year/create', [StudentYearController::class, 'StudentYearCreate'])->name('student.year.create');
    Route::post('student/year/store', [StudentYearController::class, 'StudentYearStore'])->name('student.year.store');
    Route::get('student/year/edit/{id}', [StudentYearController::class, 'StudentYearEdit'])->name('student.year.edit');
    Route::post('student/year/update/{id}', [StudentYearController::class, 'StudentYearUpdate'])->name('student.year.update');
    Route::get('student/year/delete/{id}', [StudentYearController::class, 'StudentYearDelete'])->name('student.year.delete');


    // Student Group Management All Routes
    // Route::resource('student/group/', StudentGroupController::class, [
    //     'names' => [
    //         'index' => 'student.group.view',
    //         'create' => 'student.group.create',
    //         'store' => 'student.group.store',
    //         'edit' => 'student.group.edit',
    //         'update' => 'student.group.update',
    //         'destroy' => 'student.group.delete',
    //     ]
    // ]);


    Route::get('student/group/view', [StudentGroupController::class, 'index'])->name('student.group.view');
    Route::get('student/group/create', [StudentGroupController::class, 'create'])->name('student.group.create');
    Route::post('student/group/store', [StudentGroupController::class, 'store'])->name('student.group.store');
    Route::get('student/group/edit/{id}', [StudentGroupController::class, 'edit'])->name('student.group.edit');
    Route::post('student/group/update/{id}', [StudentGroupController::class, 'update'])->name('student.group.update');
    Route::get('student/group/delete/{id}', [StudentGroupController::class, 'destroy'])->name('student.group.delete');


    // Student Shift Management All Routes
    Route::get('student/shift/view', [StudentShiftController::class, 'index'])->name('student.shift.view');
    Route::get('student/shift/create', [StudentShiftController::class, 'create'])->name('student.shift.create');
    Route::post('student/shift/store', [StudentShiftController::class, 'store'])->name('student.shift.store');
    Route::get('student/shift/edit/{id}', [StudentShiftController::class, 'edit'])->name('student.shift.edit');
    Route::post('student/shift/update/{id}', [StudentShiftController::class, 'update'])->name('student.shift.update');
    Route::get('student/shift/delete/{id}', [StudentShiftController::class, 'destroy'])->name('student.shift.delete');


    // Fee Categories Management All Routes
    Route::get('fee/category/view', [FeeCategoryController::class, 'index'])->name('fee.category.view');
    Route::get('fee/category/create', [FeeCategoryController::class, 'create'])->name('fee.category.create');
    Route::post('fee/category/store', [FeeCategoryController::class, 'store'])->name('fee.category.store');
    Route::get('fee/category/edit/{id}', [FeeCategoryController::class, 'edit'])->name('fee.category.edit');
    Route::post('fee/category/update/{id}', [FeeCategoryController::class, 'update'])->name('fee.category.update');
    Route::get('fee/category/delete/{id}', [FeeCategoryController::class, 'destroy'])->name('fee.category.delete');


});
