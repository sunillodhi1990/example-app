<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentajaxController;
use App\Http\Controllers\ExcelImportController;


use App\Models\Collage;
use App\Models\Course;

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
		$collage = Collage::get();
		$course = Course::get();
	    return view('welcome',compact('course','collage'));
	});


Route::post('student-add', [StudentajaxController::class, 'student_add']);
Route::get('student-view', [StudentajaxController::class, 'student_view']);
Route::get('student-delete', [StudentajaxController::class, 'student_delete']);
Route::post('student-edit', [StudentajaxController::class, 'student_edit']);
Route::get('student-list', [StudentajaxController::class, 'student_list']);


 
Route::resource('students', StudentController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

 Route::get('import-excel', [ExcelImportController::class, 'index'])->name('import.excel');
Route::post('import-excel', [ExcelImportController::class, 'import']);

