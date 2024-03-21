<?php
    use Illuminate\App\Http\Controllers\HomeController;
    use Illuminate\App\Http\Controllers\SeccionController;
    use Illuminate\App\Http\Controllers\VendedorController;
    use Illuminate\App\Http\Controllers\FrontController;
    use Illuminate\App\Http\Controllers\ProductoController;
    use Illuminate\App\Http\Controllers\ProductoGaleriaController;
    use Illuminate\App\Http\Controllers\PasarelaPagoCLIPController;
    use Illuminate\App\Http\Controllers\LoginController;
    use Illuminate\App\Http\Controllers\PdfController;
    use Illuminate\App\Http\Controllers\CorreosController;
    use Illuminate\App\Http\Controllers\FuncionGeneralController;
    use Illuminate\App\Http\Controllers\PedidosController;
    use Illuminate\App\Http\Controllers\AJAXController;
    use Illuminate\App\Http\Controllers\PoliticasController;
    use Illuminate\App\Http\Controllers\FAQController;


    // Rutas del front general / Sin restricciones de middleware
    Route::get('/', 'FrontController@home')->name('front.home');
    Route::get('/nosotros', 'FrontController@aboutus')->name('front.aboutus');
    Route::get('/contacto', 'FrontController@contact')->name('front.contact');
    Route::get('/tienda', 'FrontController@tienda')->name('front.tienda');
    Route::get('/factura_design', 'FrontController@factura_design')->name('front.factura_design');
    Route::get('/factura_design2', 'FrontController@factura_design2')->name('front.factura_design2');
    Route::get('/factura_design3', 'FrontController@factura_design3')->name('front.factura_design3');
    Route::get('/factura_design4', 'FrontController@factura_design4')->name('front.factura_design4');
    // Login cutomizado para el admin, redirigir en caso de estar logeado con privilegios de admin
    Route::get('/admin', 'FrontController@admin')->name('front.admin')->middleware('checkAdminAccess');

    // Rutas de sesión de usuarios
    Auth::routes();
    Route::get('/logout', 'LoginController@logout')->name('logout');

    // Rutas exclusivas del ususario tipo cliente
    Route::group(['middleware' => ['auth', 'isClient']], function() {
        Route::get('home', 'HomeController@index')->name('user.home');  // Dashboard cliente
        Route::patch('change_password/{user}', 'HomeController@change_password')->name('user.change_password');
    });

    // Rutas exclusivas del usuario tipo asesor/vendedor
    Route::group(['middleware' => ['auth', 'isSeller']], function() {
        Route::get('homeV', 'VendedorController@index')->name('vendedor.home');     // Dashboard vendedor/asesor
        Route::get('crearOrden', 'VendedorController@create')->name('vendedor.create');
        Route::post('storeCliente', 'VendedorController@storeCliente')->name('storeCliente');
        Route::post('storeCotizacion', 'VendedorController@storeCotizacion')->name('storeCotizacion');
        Route::put('change_password/{vendedor}', 'VendedorController@change_password')->name('vendedor.change_password');
    });

    // Rutas exclusivas del administrador / aquí van los subrutas auto administrables
    Route::group(['middleware' => ['auth', 'isAdmin']], function() {
        Route::get('homeA', 'SeccionController@index')->name('admin.index');
        // Route::get('catalogo_detalle/{producto}', 'SeccionController@catalogo_detalle')->name('admin.catalogo_detalle');

        Route::prefix('productos')->name('productos.')->group(function(){
            Route::get('/','ProductoController@index')->name('index');
            Route::get('/show/{producto}','ProductoController@show')->name('show');
            Route::get('/create','ProductoController@create')->name('create');
            Route::post('/store','ProductoController@store')->name('store');
        });

        Route::prefix('galeria')->name('galeria.')->group(function(){
            Route::post('/store','ProductoGaleriaController@store')->name('store');
            Route::post('/eliminar-galeria/{id}', 'TuControProductoGaleriaControllerlador@destroy');
        });

        Route::prefix('politicas')->name('politicas.')->group(function(){
            Route::get('/','PoliticasController@index')->name('index');
            Route::get('/edit/{id}','PoliticasController@edit')->name('edit');
            Route::put('/update/{id}','PoliticasController@update')->name('update');
        });

        Route::prefix('faqs')->name('faqs.')->group(function(){
            Route::get('/','FAQController@index')->name('index');
            Route::get('/create','FAQController@create')->name('create');
            Route::post('/store','FAQController@store')->name('store');
            Route::get('/show/{id}','FAQController@show')->name('show');
            Route::get('/edit/{id}','FAQController@edit')->name('edit');
            Route::put('/update/{id}','FAQController@update')->name('update');
            Route::delete('/destoy','FAQController@destroy')->name('destroy');
        });

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
        Route::post('/guardar-carrito-persistente', 'CarritoController@guardarCarritoPersistente')->name('guardar.carrito.persistente');
    });

    // Pasarela de pago CLIP, ruta exclusiva para clientes
    Route::group(['middleware' => 'isPasarelaPago'], function () {
        // PayCLIP
        Route::get('pasarela-clip', 'PasarelaPagoCLIPController@index')->name('clip.index');
        Route::get('clip_success', 'PasarelaPagoCLIPController@clip_success')->name('clip.clip_success');
        Route::get('clip_error', 'PasarelaPagoCLIPController@clip_error')->name('clip.clip_error');
        // Conekta
        // OpenPay
        // PayPal
        // Stripe
    });

    // Rutas para editar usando AJAX
    Route::patch('/editarajax', 'AJAXController@editarajax');
    Route::post('cambiar_imagen', 'AJAXController@cambiar_imagen')->name('cambiar_imagen');
    Route::post('/switch_inicio', 'AJAXController@switch_inicio')->name('ajax.switch_inicio');
    Route::post('/switch_ocultar', 'AJAXController@switch_ocultar')->name('ajax.switch_ocultar');
    Route::post('/switch_eliminar', 'AJAXController@switch_eliminar')->name('ajax.switch_eliminar');
    Route::post('/cancelar_cotizacion', 'AJAXController@cancelar_cotizacion')->name('ajax.cancelar_cotizacion');
    // Genear facturas
    Route::get('/pdf', 'PdfController@generatePdf');
    Route::get('/pdf_factura', 'PdfController@generatePdf_factura');
    /** rutas de los formularios de contacto */
    Route::post('/correo', 'CorreosController@correo')->name('correo');

