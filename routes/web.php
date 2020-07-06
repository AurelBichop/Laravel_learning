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

/**
 * Courses
 */
Route::get('/courses', 'CoursesController@courses')->name('courses');
Route::get('/courses/{slug}', 'CoursesController@course')->name('course.show');

/**
 * Vue formateur
 */
Route::get('/instructor/overview', 'InstructorController@index')->name('instructor.index');
Route::get('/instructor/new', 'InstructorController@create')->name('instructor.create');
Route::post('/instructor/store', 'InstructorController@store')->name('instructor.store');
Route::get('/instructor/courses/{id}/edit/', 'InstructorController@edit')->name('instructor.edit');
Route::put('/instructor/courses/{id}/update', 'InstructorController@update')->name('instructor.update');
Route::get('/instructor/courses/{id}/destroy', 'InstructorController@destroy')->name('instructor.destroy');
Route::get('/instructor/courses/{id}/publish', 'InstructorController@publish')->name('instructor.publish');
Route::get('/instructor/courses/{id}/participants', 'InstructorController@participant')->name('instructor.participants');

/**
 * Tarification
 */
Route::get('/instructor/courses/{id}/pricing', 'PricingController@pricing')->name('pricing.index');
Route::post('/instructor/courses/{id}/pricing/store', 'PricingController@store')->name('pricing.store');

/**
 * Plan de cours
 */
Route::get('/instructor/courses/{id}/curriculum', 'CurriculumController@index')->name('instructor.curriculum.index');
Route::get('/instructor/courses/{id}/curriculum/add', 'CurriculumController@create')->name('instructor.curriculum.create');
Route::post('/instructor/courses/{id}/curriculum/store', 'CurriculumController@store')->name('instructor.curriculum.store');
Route::get('/instructor/courses/{id}/curriculum/{section}/edit', 'CurriculumController@edit')->name('instructor.curriculum.edit');
Route::put('/instructor/courses/{id}/curriculum/{section}/update', 'CurriculumController@update')->name('instructor.curriculum.update');
Route::get('/instructor/courses/{id}/curriculum/{section}/destroy', 'CurriculumController@destroy')->name('instructor.curriculum.destroy');

/**
 * Cart
 */
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::get('/cart/{id}/store', 'CartController@store')->name('cart.store');
Route::get('/cart/{id}/destroy', 'CartController@destroy')->name('cart.destroy');
Route::get('/cart/clear', 'CartController@clear')->name('cart.clear');

/**
 * WishList
 */
Route::get('/wish/{id}/store', 'WishListController@store')->name('wish.store');
Route::get('/wish/{id}/destroy', 'WishListController@destroy')->name('wish.destroy');
Route::get('/wish/{id}/tocart', 'WishListController@toCart')->name('wish.tocart');
Route::get('/wish/{id}/towish', 'WishListController@toWishList')->name('wish.towish');

/**
 * Checkout
 */
Route::get('/checkout', 'CheckoutController@checkout')->name('checkout.payement');
Route::post('/checkout/charge', 'CheckoutController@charge')->name('checkout.charge');
Route::get('/checkout/success', 'CheckoutController@success')->name('checkout.success');
