<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseStudentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MaterialController;


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

Route::get('/', function () {
    return view('course.login');
});
Route::get('home', function () {
    return view('home');
});

Route::get('student', function () {
    return view('student.createSt');
});

Route::get('stdC', function () {
    return view('admin.stdCor');
});

Route::get('course/create', function () {
    return view('admin.create');
});


Route::resource('login', UserController::class) ;
 Route::resource('course', CourseController::class) ;
 Route::resource('category', CategoryController::class) ;
 Route::resource('student', StudentController::class) ;
 Route::resource('course-students', CourseStudentController::class);
 Route::resource('payment', PaymentController::class) ;
 Route::get('payments/create/{course_student_id}', 'App\Http\Controllers\PaymentController@create')->name('payments.create');
 Route::post('payments/{course_student_id}', 'App\Http\Controllers\PaymentController@store')->name('payments.store');
 Route::get('payments/index/{course_student_id}', 'App\Http\Controllers\PaymentController@index')->name('payment.index');
 Route::get('payments/view/{course_student_id}', 'App\Http\Controllers\PaymentController@show')->name('payments.show');

 
Route::get('reg/create/{course_id}', 'App\Http\Controllers\CourseStudentController@create')->name('register.create');
Route::get('reg/{course_id}', 'App\Http\Controllers\CourseStudentController@index')->name('register.index');
Route::post('reg/{course_id}', 'App\Http\Controllers\CourseStudentController@store')->name('register.store');


 Route::patch('students/{student}', 'App\Http\Controllers\StudentController@toggleActivation')->name('student.toggleActivation');

 Route::resource('group', GroupController::class);
Route::resource('material', MaterialController::class);
Route::get('materialView', function () {
    return view('admin.material');
});

Route::get('mat/create/{group_id}', 'App\Http\Controllers\MaterialController@create')->name('mate.create');
Route::get('mat/{group_id}', 'App\Http\Controllers\MaterialController@index')->name('mate.index');
Route::post('mat/{group_id}', 'App\Http\Controllers\MaterialController@store')->name('material.store');

Route::get('group/create/{course_id}', 'App\Http\Controllers\GroupController@create')->name('groups.create');
Route::get('gro/{course_id}', 'App\Http\Controllers\GroupController@index')->name('groups.index');
Route::post('gro/{course_id}', 'App\Http\Controllers\GroupController@store')->name('group.store');

// Route::get('materials/{course_id}', 'App\Http\Controllers\CourseController@show')->name('courses.show');
Route::get('/download/{filePath}', 'App\Http\Controllers\MaterialController@downloadFile')->name('mate.downloadFile');








