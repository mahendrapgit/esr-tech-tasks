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
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('home');
    });
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('companies', 'CompanyController');
Route::resource('employees', 'EmployeeController');
Route::get('test', function () {
    event(new \App\Events\EmployeeAdded('Someone'));
    return "Event has been sent!";
});