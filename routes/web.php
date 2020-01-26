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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', function(){
    return view('layouts.check_dr');
})->name('check-dr');

/*Dashboard*/
Route::get('/home', 'HomeController@index')->name('home');
/*CSV*/
Route::get('/csv/upload', 'UploadCsvController@index')->name('csv');
Route::post('/csv/upload', 'UploadCsvController@upload')->name('csv-upload');
Route::get('/csv/upload/files', 'UploadCsvController@files')->name('csv-files');
Route::get('/csv/upload/dr/{id}', 'UploadCsvController@get_dr_per_file')->name('csv-files-dr');
Route::get('/csv/history', 'UploadCsvController@history')->name('csv-history');
/*Reports*/
Route::get('/reports/per-transaction', 'ReportsController@per_transaction')->name('reports-transaction');


Route::get('/admin', 'auth\LoginController@showLoginForm')->name('showlogin');
Route::post('/admin', 'auth\LoginController@login')->name('login');

Route::get('/admin/password_reset', 'auth\LoginController@showLoginForm')->name('password.request');



