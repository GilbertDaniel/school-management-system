<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\Setup\ExamTypeController;
use App\Http\Controllers\Backend\Setup\FeeCategoryAmoutController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\SchoolSubjectController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Setup\AssignSubjectController;
use App\Http\Controllers\Backend\Setup\DesignationController;
use App\Http\Controllers\Backend\Student\RegController;
use App\Http\Controllers\Backend\Student\StudentRollController;
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


    // Fee Category Amount Management All Routes
    Route::get('fee/amount/view', [FeeCategoryAmoutController::class, 'index'])->name('fee.amount.view');
    Route::get('fee/amount/show/{id}', [FeeCategoryAmoutController::class, 'show'])->name('fee.amount.show');
    Route::get('fee/amount/create', [FeeCategoryAmoutController::class, 'create'])->name('fee.amount.create');
    Route::post('fee/amount/store', [FeeCategoryAmoutController::class, 'store'])->name('fee.amount.store');
    Route::get('fee/amount/edit/{id}', [FeeCategoryAmoutController::class, 'edit'])->name('fee.amount.edit');
    Route::post('fee/amount/update/{id}', [FeeCategoryAmoutController::class, 'update'])->name('fee.amount.update');
    Route::get('fee/amount/delete/{id}', [FeeCategoryAmoutController::class, 'destroy'])->name('fee.amount.delete');

    // Exam Route Management All Routes
    Route::get('exam/type/view', [ExamTypeController::class, 'index'])->name('exam.type.view');
    Route::get('exam/type/create', [ExamTypeController::class, 'create'])->name('exam.type.create');
    Route::post('exam/type/store', [ExamTypeController::class, 'store'])->name('exam.type.store');
    Route::get('exam/type/edit/{id}', [ExamTypeController::class, 'edit'])->name('exam.type.edit');
    Route::post('exam/type/update/{id}', [ExamTypeController::class, 'update'])->name('exam.type.update');
    Route::get('exam/type/delete/{id}', [ExamTypeController::class, 'destroy'])->name('exam.type.delete');

    // School Subject Management All Routes
    Route::get('school/subject/view', [SchoolSubjectController::class, 'index'])->name('school.subject.view');
    Route::get('school/subject/create', [SchoolSubjectController::class, 'create'])->name('school.subject.create');
    Route::post('school/subject/store', [SchoolSubjectController::class, 'store'])->name('school.subject.store');
    Route::get('school/subject/edit/{id}', [SchoolSubjectController::class, 'edit'])->name('school.subject.edit');
    Route::post('school/subject/update/{id}', [SchoolSubjectController::class, 'update'])->name('school.subject.update');
    Route::get('school/subject/delete/{id}', [SchoolSubjectController::class, 'destroy'])->name('school.subject.delete');

    // Assign Subject Management All Routes
    Route::get('assign/subject/view', [AssignSubjectController::class, 'index'])->name('assign.subject.view');
    Route::get('assign/subject/show/{id}', [AssignSubjectController::class, 'show'])->name('assign.subject.show');
    Route::get('assign/subject/create', [AssignSubjectController::class, 'create'])->name('assign.subject.create');
    Route::post('assign/subject/store', [AssignSubjectController::class, 'store'])->name('assign.subject.store');
    Route::get('assign/subject/edit/{id}', [AssignSubjectController::class, 'edit'])->name('assign.subject.edit');
    Route::post('assign/subject/update/{id}', [AssignSubjectController::class, 'update'])->name('assign.subject.update');
    Route::get('assign/subject/delete/{id}', [AssignSubjectController::class, 'destroy'])->name('assign.subject.delete');

    // Designation Management All Routes
    Route::get('designation/view', [DesignationController::class, 'index'])->name('designation.view');
    Route::get('designation/create', [DesignationController::class, 'create'])->name('designation.create');
    Route::post('designation/store', [DesignationController::class, 'store'])->name('designation.store');
    Route::get('designation/edit/{id}', [DesignationController::class, 'edit'])->name('designation.edit');
    Route::post('designation/update/{id}', [DesignationController::class, 'update'])->name('designation.update');
    Route::get('designation/delete/{id}', [DesignationController::class, 'destroy'])->name('designation.delete');

});


// Student Management All Routes
Route::prefix('students')->group(function(){
    Route::get('/admission/view', [RegController::class, 'index'])->name('student.admission.view');
    Route::get('/admission/create', [RegController::class, 'create'])->name('student.admission.create');
    Route::post('/admission/store', [RegController::class, 'store'])->name('student.admission.store');
    Route::get('/admission/edit/{id}', [RegController::class, 'edit'])->name('student.admission.edit');
    Route::post('/admission/update/{id}', [RegController::class, 'update'])->name('student.admission.update');
    Route::get('/admission/filter', [RegController::class, 'StudentWiseFilter'])->name('student.admission.filter');
    Route::get('/admission/show/{id}', [RegController::class, 'show'])->name('student.admission.show');


    Route::get('/roll/generate/view', [StudentRollController::class, 'StudentRollView'])->name('roll.generate.view');
    Route::get('/reg/getstudents', [StudentRollController::class, 'GetStudents'])->name('student.registration.getstudents');
    Route::post('/roll/generate/store', [StudentRollController::class, 'StudentRollStore'])->name('roll.generate.store');



});
