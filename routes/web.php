<?php

    use Illuminate\App\Http\Controllers\HomeController;
    use Illuminate\App\Http\Controllers\SeccionController;
    use Illuminate\App\Http\Controllers\VendedorController;
    use Illuminate\App\Http\Controllers\FrontController;
    use Illuminate\App\Http\Controllers\ProductoController;
    use Illuminate\App\Http\Controllers\PasarelaPagoCLIPController;
    use Illuminate\App\Http\Controllers\LoginController;


    Route::get('/', 'FrontController@index')->name('front.home');
    Route::get('/productos', 'ProductoController@index')->name('front.productos');

    Auth::routes();
    Route::get('/logout', 'LoginController@logout')->name('logout');

    Route::group(['middleware' => ['auth', 'isClient']], function() {
        Route::get('home', 'HomeController@index')->name('user.home');
    });

    Route::group(['middleware' => ['auth', 'isSeller']], function() {
        Route::get('homeV', 'VendedorController@index')->name('vendedor.home');
    });

    Route::group(['middleware' => ['auth', 'isAdmin']], function() {
        Route::get('admin', 'SeccionController@index')->name('admin.index');
    });

    Route::group(['middleware' => 'isCarrito'], function () {
        Route::get('cart', 'CarritoController@index')->name('cart.index');
        Route::get('add-to-cart/{id}', 'CarritoController@addToCart')->name('cart.addToCart');
        Route::patch('update-cart', 'CarritoController@update')->name('cart.update');
        Route::delete('remove-cart', 'CarritoController@remove')->name('cart.remove');
        Route::get('datos-envio', 'CarritoController@datosEnvio')->name('cart.datosEnvio');
    });

    Route::group(['middleware' => 'isPasarelaPago'], function () {
        Route::get('pasarela-clip', 'PasarelaPagoCLIPController@index')->name('clip.index');
    });


