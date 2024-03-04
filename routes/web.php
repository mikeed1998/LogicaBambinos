<?php

    use Illuminate\App\Http\Controllers\HomeController;
    use Illuminate\App\Http\Controllers\SeccionController;
    use Illuminate\App\Http\Controllers\VendedorController;
    use Illuminate\App\Http\Controllers\FrontController;
    use Illuminate\App\Http\Controllers\ProductoController;
    use Illuminate\App\Http\Controllers\PasarelaPagoCLIPController;
    use Illuminate\App\Http\Controllers\LoginController;
    use Illuminate\App\Http\Controllers\PdfController;
    use Illuminate\App\Http\Controllers\CorreosController;
    use Illuminate\App\Http\Controllers\FuncionGeneralController;
    use Illuminate\App\Http\Controllers\PedidosController;


    // Rutas del front general / Sin restricciones de middleware
    Route::get('/', 'FrontController@home')->name('front.home');
    Route::get('/nosotros', 'FrontController@aboutus')->name('front.aboutus');
    Route::get('/contacto', 'FrontController@contact')->name('front.contact');
    // Rutas publicas para productos
    Route::get('/productos', 'ProductoController@index')->name('front.productos');
    // Login cutomizado para el admin, redirigir en caso de estar logeado con privilegios de admin
    Route::get('/admin', 'FrontController@admin')->name('front.admin')->middleware('checkAdminAccess');

    // Rutas de sesión de ususarios
    Auth::routes();
    Route::get('/logout', 'LoginController@logout')->name('logout');

    // Rutas exclusivas del ususario tipo cliente
    Route::group(['middleware' => ['auth', 'isClient']], function() {
        Route::get('home', 'HomeController@index')->name('user.home');
    });

    // Rutas exclusivas del usuario tipo vendedor
    Route::group(['middleware' => ['auth', 'isSeller']], function() {
        Route::get('homeV', 'VendedorController@index')->name('vendedor.home');
        Route::get('crearOrden', 'VendedorController@create')->name('vendedor.create');
        Route::post('storeCliente', 'VendedorController@storeCliente')->name('storeCliente');
        Route::post('storeCotizacion', 'VendedorController@storeCotizacion')->name('storeCotizacion');
    });

    // Rutas exclusivas del administrador / aquí van los subrutas autoadministrables
    Route::group(['middleware' => ['auth', 'isAdmin']], function() {
        Route::get('homeA', 'SeccionController@index')->name('admin.index');
        Route::get('contacto', 'SeccionController@contacto')->name('admin.contacto');
        Route::post('textglobalseccion','SeccionController@textglobalseccion')->name('textglobalseccion');
        Route::prefix('secciones')->name('seccion.')->group(function(){
            Route::get('/','SeccionController@index')->name('index');
			Route::get('/{slug}','SeccionController@show')->name('show');
        });
    });

    // Rutas para el acceso y manipulación del carrito de compras, ruta exclusiva para clientes
    Route::group(['middleware' => 'isCarrito'], function () {
        Route::get('cart', 'CarritoController@index')->name('cart.index');
        Route::get('add-to-cart/{id}', 'CarritoController@addToCart')->name('cart.addToCart');
        Route::patch('update-cart', 'CarritoController@update')->name('cart.update');
        Route::delete('remove-cart', 'CarritoController@remove')->name('cart.remove');
        Route::delete('cart/clear', 'CarritoController@clearCart')->name('cart.clear');
        Route::get('datos-envio', 'CarritoController@datosEnvio')->name('cart.datosEnvio');
    });

    // Pasarela de pago CLIP, ruta exclusiva para clientes
    Route::group(['middleware' => 'isPasarelaPago'], function () {
        Route::get('pasarela-clip', 'PasarelaPagoCLIPController@index')->name('clip.index');
        Route::get('clip_success', 'PasarelaPagoCLIPController@clip_success')->name('clip.clip_success');
        Route::get('clip_error', 'PasarelaPagoCLIPController@clip_error')->name('clip.clip_error');
    });

    // rutas funciones generales AJAX
    Route::prefix('varios')->name('func.')->group(function(){
        Route::post('editarajax','FuncionGeneralController@editajax')->name('editajax');
    });

    // Genear facturas
    Route::get('/pdf', 'PdfController@generatePdf');

   /** rutas de los formularios de contacto */
    Route::post('/correo', 'CorreosController@correo')->name('correo');


