<?php

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

Route::get('/', 'PageController@index')->name('index');
Route::get('/profiel', 'PageController@profile')->name('profile');
Route::get('/dashboard', 'PageController@dashboard')->name('dashboard');
Route::get('/motivatie', 'PageController@motivation')->name('motivation');
Route::get('/beroepsbeeld', 'PageController@vision')->name('vision');
Route::get('/contact', 'PageController@contact')->name('contact');

Route::resource('/api/courses', 'CourseController')->except([
    'create', 'edit',
]);
Route::resource('/api/subjects', 'SubjectController')->except([
    'create', 'edit',
]);
Route::resource('/api/grades', 'GradeController')->except([
    'create', 'edit',
]);

Route::get('/{code}/{msg?}', function($code, $msg = '') {
    abort($code, $msg);
})->where('code', '[0-9]{3}');