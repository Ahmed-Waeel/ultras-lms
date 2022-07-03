<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
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
    return view('welcome');
});

Route::get('/admin',  [AdminController::class,'index'])->name('admin.home');
Route::get('/admin/courses',  [CourseController::class,'showCourses'])->name('courses.show');
Route::post('/admin/courses',  [CourseController::class,'searchCourses'])->name('courses.search');
Route::get('/admin/courses/course/{course_id}',  [CourseController::class,'showCourse'])->name('course.show');
Route::get('/admin/course/add',  [CourseController::class,'create'])->name('course.create');
Route::post('/admin/course/store',  [CourseController::class,'store'])->name('course.store');
Route::get('/admin/course/edit/{course_id}',  [CourseController::class,'edit'])->name('course.edit');
Route::post('/admin/course/update',  [CourseController::class,'update'])->name('course.update');
Route::get('/admin/course/delete/{id}',  [CourseController::class,'delete'])->name('course.delete');


Route::get('/admin/categories',  [CategoryController::class,'showCategories'])->name('categories.show');
Route::post('/admin/categories',  [CategoryController::class,'searchCategories'])->name('categories.search');
Route::get('/admin/categories/category/{category_id}',  [CategoryController::class,'showCategory'])->name('category.show');
Route::get('/admin/category/add',  [CategoryController::class,'create'])->name('category.create');
Route::post('/admin/category/store',  [CategoryController::class,'store'])->name('category.store');
Route::get('/admin/category/edit/{category_id}',  [CategoryController::class,'edit'])->name('category.edit');
Route::post('/admin/category/update',  [CategoryController::class,'update'])->name('category.update');
Route::get('/admin/category/delete/{id}',  [CategoryController::class,'delete'])->name('category.delete');

