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

Route::get('/get-dr','HomeController@checkDR');


Route::get('/home', 'Admin\HomeController@index')->name('home');

Route::prefix('encoder')->group(function () {

    /*Dashboard*/
    Route::get('/home', 'Encoder\HomeController@index')->name('home');

    /* PENDING */
    Route::prefix('pending')->group(function () {
        Route::get('/', 'Encoder\PendingTransactionController@index');
        Route::get('/items/{id}', 'Encoder\PendingTransactionController@items');
        Route::get('/update/{dr}/{status}', 'Encoder\PendingTransactionController@update_item');
        Route::get('/dr/update_all/{dr}/{mode}', 'Encoder\PendingTransactionController@update_all');
        Route::get('/confirm/{dr}/{date}', 'Encoder\PendingTransactionController@confirm');
        Route::get('/confirm_all/{dr}/{date}', 'Encoder\PendingTransactionController@confirm_all');
    });

    /* INTRANSIT */
    Route::prefix('intransit')->group(function () {
        Route::get('/', 'Encoder\InTransitController@index');
        Route::get('/items/{id}', 'Encoder\InTransitController@items');
    });
    /* CONFIRMED */
    Route::prefix('confirmed')->group(function () {
        Route::get('/', 'Encoder\ConfirmedController@index');
        Route::get('/items/{id}', 'Encoder\ConfirmedController@items');
    });

    /* DELIVERED */
    Route::prefix('delivered')->group(function () {
        Route::get('/', 'Encoder\DeliveredController@index');
        Route::get('/items/{id}', 'Encoder\DeliveredController@items');
    });

    /* BACKLOAD */
    Route::prefix('backload')->group(function () {
        Route::get('/', 'Encoder\BackloadController@index');
        Route::get('/items/{id}', 'Encoder\BackloadController@items');
    });

});
Route::prefix('agent')->group(function () {

    /*Dashboard*/
    Route::get('/home', 'Agent\HomeController@index')->name('home');

    /* INTRANSIT */
    Route::prefix('intransit')->group(function () {
        Route::get('/', 'Agent\InTransitController@index');
        Route::get('/items/{id}', 'Agent\InTransitController@items');
        Route::get('/update/{dr}/{status}', 'Agent\InTransitController@update_item');
        Route::get('/dr/update_all/{dr}/{mode}', 'Agent\InTransitController@update_all');
        Route::get('/confirm/{dr}/{date}', 'Agent\InTransitController@confirm');
        Route::get('/confirm_all/{dr}/{date}', 'Agent\InTransitController@confirm_all');
    });
    /* CONFIRMED */
    Route::prefix('confirmed')->group(function () {
        Route::get('/', 'Agent\ConfirmedController@index');
        Route::get('/items/{id}', 'Agent\ConfirmedController@items');
        Route::get('/update/{dr}/{status}', 'Agent\ConfirmedController@update_item');
        Route::get('/dr/update_all/{dr}/{mode}', 'Agent\ConfirmedController@update_all');
        Route::get('/confirm/{dr}/{date}', 'Agent\ConfirmedController@confirm');
        Route::get('/confirm_all/{dr}/{date}', 'Agent\ConfirmedController@confirm_all');
    });

    /* DELIVERED */
    Route::prefix('delivered')->group(function () {
        Route::get('/', 'Agent\DeliveredController@index');
        Route::get('/items/{id}', 'Agent\DeliveredController@items');
    });

    /* BACKLOAD */
    Route::prefix('backload')->group(function () {
        Route::get('/', 'Agent\BackloadController@index');
        Route::get('/items/{id}', 'Agent\BackloadController@items');
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
        Route::post('/branch/upload/production/', 'Admin\BranchController@upload')->name('branch-upload');
        Route::get('/branch/dealers/{csv}', 'Admin\BranchController@dealers')->name('branch-dealers');
        Route::get('/branch/outlets/{csv}', 'Admin\BranchController@outlets')->name('branch-outlets');

        /* Dealer */
        Route::get('/dealers', 'Admin\DealerController@dealers')->name('dealer');
        Route::get('/dealers/outlets/{id}', 'Admin\DealerController@outlets')->name('dealer_outlet');
        Route::get('/dealers/update/{id}', 'Admin\DealerController@update_dealer')->name('dealer_update');

        /* Users */
        Route::get('/users', 'Admin\UserController@index')->name('users');
        Route::get('/users/create', 'Admin\UserController@create_user')->name('users_create');
        Route::post('/users/save', 'Admin\UserController@store_user')->name('users_save');
        Route::get('/users/details/{id}', 'Admin\UserController@details_user')->name('users_update');
        Route::post('/users/update/{id}', 'Admin\UserController@update_user')->name('users_update');
        Route::get('/users/edit/{id}', 'Admin\UserController@edit_user')->name('users_update');
        Route::get('/users/block/{id}', 'Admin\UserController@block_user')->name('users_block');
        Route::get('/users/unblock/{id}', 'Admin\UserController@unblock_user')->name('users_unblock');

        Route::get('/users/password_reset/{id}', 'Admin\UserController@password_reset')->name('users_password_reset');
        Route::get('/users/password_change/{id}', 'Admin\UserController@password_change')->name('users_password_change');

        /* Dealers */


    });

});

/* Login */
Route::get('/admin', 'Auth\LoginController@showLoginForm')->name('showlogin');
Route::post('/admin', 'Auth\LoginController@login')->name('login');

Route::get('/admin/password_reset', 'Auth\LoginController@showLoginForm')->name('password.request');



