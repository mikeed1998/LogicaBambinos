<?php

    use Illuminate\App\Http\Controllers\HomeController;
    use Illuminate\App\Http\Controllers\SeccionController;
    use Illuminate\App\Http\Controllers\VendedorController;
    use Illuminate\App\Http\Controllers\FrontController;

    Route::get('/', 'FrontController@index')->name('front.home');

    Auth::routes();

    Route::group(['middleware' => ['auth', 'isClient']], function() {
        Route::get('home', 'HomeController@index')->name('user.home');
    });

    Route::group(['middleware' => ['auth', 'isSeller']], function() {
        Route::get('homeV', 'VendedorController@index')->name('vendedor.home');
    });

    Route::group(['middleware' => ['auth', 'isAdmin']], function() {
        Route::get('admin', 'SeccionController@index')->name('admin.index');
    });

