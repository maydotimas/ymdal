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

Route::get('/', function () {
    return view('layouts.check_dr');
})->name('check-dr');

Route::prefix('encoder')->group(function () {

    /*Dashboard*/
    Route::get('/home', 'Encoder\HomeController@index')->name('home');

});


Route::prefix('admin')->group(function () {

    /*Dashboard*/
    Route::get('/home', 'Admin\HomeController@index')->name('home');

    /*CSV*/
    Route::get('/csv/upload', 'Admin\UploadCsvController@index')->name('csv');
    Route::post('/csv/upload', 'Admin\UploadCsvController@upload')->name('csv-upload');
    Route::get('/csv/upload/files', 'Admin\UploadCsvController@files')->name('csv-files');
    Route::get('/csv/upload/csv/{id}', 'Admin\UploadCsvController@get_dr_per_file')->name('csv-files-dr');
    Route::get('/csv/upload/dr/{id}', 'Admin\UploadCsvController@get_items_per_file')->name('csv-items-dr');
    Route::get('/csv/upload/production/', 'Admin\UploadCsvController@upload_to_production')->name('csv-to-prod');
    Route::get('/csv/recall/', 'Admin\UploadCsvController@recall')->name('csv-recall');
    Route::get('/csv/delete/', 'Admin\UploadCsvController@delete')->name('csv-delete');

    /* DR History */
    Route::get('/csv/history', 'Admin\UploadCsvController@history')->name('csv-history');

    /*Reports*/
    Route::get('/reports/per-transaction', 'Admin\ReportsController@per_transaction')->name('reports-transaction');

    /* Branch Upload */
    Route::get('/branch/upload', 'Admin\BranchController@index')->name('branch');
    Route::post('/branch/upload', 'Admin\BranchController@upload')->name('branch-upload');
});

/* Login */
Route::get('/admin', 'auth\LoginController@showLoginForm')->name('showlogin');
Route::post('/admin', 'auth\LoginController@login')->name('login');

Route::get('/admin/password_reset', 'auth\LoginController@showLoginForm')->name('password.request');



