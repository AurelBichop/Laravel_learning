<?php

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

Route::get('/', 'MainController@home')->name('main.home');


Auth::routes();

Route::get('/logout', function(){
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/instructor/overview', 'InstructorController@index')->name('instructor.index');
Route::get('/instructor/new', 'InstructorController@create')->name('instructor.create');
Route::post('/instructor/store', 'InstructorController@store')->name('instructor.store');
Route::get('/instructor/courses/{id}/edit/', 'InstructorController@edit')->name('instructor.edit');
Route::put('/instructor/courses/{id}/update', 'InstructorController@update')->name('instructor.update');
Route::get('/instructor/courses/{id}/destroy', 'InstructorController@destroy')->name('instructor.destroy');

Route::get('/instructor/courses/{id}/pricing', 'PricingController@pricing')->name('pricing.index');
Route::post('/instructor/courses/{id}/store', 'PricingController@store')->name('pricing.store');


Route::get('/instructor/courses/{id}/curriculum', 'CurriculumController@index')->name('instructor.curriculum.index');

Route::get('/instructor/courses/{id}/curriculum/add', 'CurriculumController@create')->name('instructor.curriculum.create');
Route::post('/instructor/courses/{id}/curriculum/store', 'CurriculumController@store')->name('instructor.curriculum.store');

Route::get('/instructor/courses/{id}/curriculum/{section}/edit', 'CurriculumController@edit')->name('instructor.curriculum.edit');
Route::put('/instructor/courses/{id}/curriculum/{section}/update', 'CurriculumController@update')->name('instructor.curriculum.update');

Route::get('/instructor/courses/{id}/curriculum/{section}/destroy', 'CurriculumController@destroy')->name('instructor.curriculum.destroy');
