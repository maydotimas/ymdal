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


Route::get('/home', 'Admin\HomeController@index')->name('home');

Route::prefix('encoder')->group(function () {

    /*Dashboard*/
    Route::get('/home', 'Encoder\HomeController@index')->name('home');


    /* PENDING */
    Route::prefix('pending')->group(function () {
        Route::get('/', 'Encoder\PendingTransactionController@pending')->name('pending');
        Route::get('/items/{id}', 'Encoder\PendingTransactionController@pending_items')->name('pending_items');
        Route::get('/update/{dr}/{status}', 'Encoder\PendingTransactionController@update_pending_item')->name('update_pending_items');
        Route::get('/dr/check_all/{dr}', 'Encoder\PendingTransactionController@check_all')->name('check_all_pending_items');
        Route::get('/dr/uncheck_all/{dr}/', 'Encoder\PendingTransactionController@uncheck_all')->name('uncheck_all_pending_items');
        Route::get('/confirm/{dr}/{date}', 'Encoder\PendingTransactionController@confirm')->name('confirm_pending_items');
        Route::get('/confirm_all/{dr}/{date}', 'Encoder\PendingTransactionController@confirm_all')->name('confirm_all_pending_items');
    });

    /* INTRANSIT */
    Route::prefix('intransit')->group(function () {
        Route::get('/', 'Encoder\InTransitController@intransit')->name('intransit');
        Route::get('/items/{id}', 'Encoder\InTransitController@intransit_items')->name('intransit_items');
    });
    /* CONFIRMED */
    Route::prefix('confirmed')->group(function () {
        Route::get('/', 'Encoder\ConfirmedController@confirmed')->name('confirmed');
        Route::get('/items/{id}', 'Encoder\ConfirmedController@confirmed_items')->name('confirmed_items');
    });

    /* DELIVERED */
    Route::prefix('delivered')->group(function () {
        Route::get('/', 'Encoder\DeliveredController@delivered')->name('delivered');
        Route::get('/items/{id}', 'Encoder\DeliveredController@delivered_items')->name('delivered_items');
    });

    /* BACKLOAD */
    Route::prefix('backload')->group(function () {
        Route::get('/', 'Encoder\BackloadController@backload')->name('backload');
        Route::get('/items/{id}', 'Encoder\BackloadController@backload_items')->name('backload_items');
    });

});
Route::prefix('agent')->group(function () {

    /*Dashboard*/
    Route::get('/home', 'Agent\HomeController@index')->name('home');


    /* PENDING */
   /* Route::prefix('pending')->group(function () {
        Route::get('/', 'Agent\PendingTransactionController@pending')->name('pending-agent');
        Route::get('/items/{id}', 'Agent\PendingTransactionController@pending_items')->name('pending_items-agent');
        Route::get('/update/{dr}/{status}', 'Agent\PendingTransactionController@update_pending_item')->name('update_pending_items-agent');
        Route::get('/dr/check_all/{dr}', 'Agent\PendingTransactionController@check_all')->name('check_all_pending_items-agent');
        Route::get('/dr/uncheck_all/{dr}/', 'Agent\PendingTransactionController@uncheck_all')->name('uncheck_all_pending_items-agent');
        Route::get('/confirm/{dr}/{date}', 'Agent\PendingTransactionController@confirm')->name('confirm__pending_items-agent');
        Route::get('/confirm_all/{dr}/{date}', 'Agent\PendingTransactionController@confirm_all')->name('confirm_all_pending_items-agent');
    });*/

    /* INTRANSIT */
    Route::prefix('intransit')->group(function () {
        Route::get('/', 'Agent\InTransitController@intransit')->name('intransit-agent');
        Route::get('/items/{id}', 'Agent\InTransitController@intransit_items')->name('intransit_items-agent');
    });
    /* CONFIRMED */
    Route::prefix('confirmed')->group(function () {
        Route::get('/', 'Agent\ConfirmedController@confirmed')->name('confirmed-agent');
        Route::get('/items/{id}', 'Agent\ConfirmedController@confirmed_items')->name('confirmed_items-agent');
    });

    /* DELIVERED */
    Route::prefix('delivered')->group(function () {
        Route::get('/', 'Agent\DeliveredController@delivered')->name('delivered-agent');
        Route::get('/items/{id}', 'Agent\DeliveredController@delivered_items')->name('delivered_items-agent');
    });

    /* BACKLOAD */
    Route::prefix('backload')->group(function () {
        Route::get('/', 'Agent\BackloadController@backload')->name('backload-agent');
        Route::get('/items/{id}', 'Agent\BackloadController@backload_items')->name('backload_items-agent');
    });

});
Route::prefix('admin')->group(function () {

    Route::middleware(['isAdmin'])->group(function () {
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
        Route::get('/csv/history', 'Admin\UploadHistoryController@index')->name('csv-history');
        Route::get('/csv/history/download', 'Admin\UploadHistoryController@download')->name('csv-history-download');

        /*Reports*/
        Route::get('/reports/per-transaction', 'Admin\ReportsController@per_transaction')->name('reports-transaction');
        Route::get('/reports/per-transaction/download', 'Admin\ReportsController@per_transaction_download')->name('reports-transaction_download');

        /* Branch Upload */
        Route::get('/branch/upload', 'Admin\BranchController@index')->name('branch');
        Route::post('/branch/upload', 'Admin\BranchController@upload')->name('branch-upload');
        Route::get('/branch/dealers/{csv}', 'Admin\BranchController@dealers')->name('branch-dealers');
        Route::get('/branch/outlets/{csv}', 'Admin\BranchController@outlets')->name('branch-outlets');

    });

});

/* Login */
Route::get('/admin', 'Auth\LoginController@showLoginForm')->name('showlogin');
Route::post('/admin', 'Auth\LoginController@login')->name('login');

Route::get('/admin/password_reset', 'Auth\LoginController@showLoginForm')->name('password.request');



