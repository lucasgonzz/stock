<?php
use Zend\Barcode\Barcode;

Route::get('/', function () {
    return redirect()->route('venta');
});

// Authentication

Route::get('login', 'Auth\LoginController@showLoginForm')->name('show-login-form')->middleware('guest');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Obtener codigos de barras disponibles para vista de venta
Route::get('bar-codes', function(){
    $codigos = App\Article::all()->pluck('bar_code');
    return $codigos;
});

// Main
Route::get('venta', 'MainController@venta')->name('venta');
Route::get('ingresar', 'MainController@ingresar')->name('ingresar');
Route::get('lista-precios', 'MainController@lista_de_precios')->name('lista-precios');
Route::get('resumen-ventas', 'MainController@resumen_ventas')->name('resumen-ventas');
Route::get('codigos-de-barras', 'MainController@codigos_de_barras')->name('codigos-de-barras');

// Providers
Route::get('providers', 'ProviderController@index');
Route::post('providers', 'ProviderController@store');

// Articles
Route::post('articles/index', 'ArticleController@index');
Route::resource('articles', 'ArticleController');
Route::get('articles/search/{search}', 'ArticleController@search');
Route::put('articles/{id}', 'ArticleController@update');

// Sales
// Vista de resumen de ventas
Route::get('sales/today', 'SaleController@today');
Route::get('sales/morning', 'SaleController@morning');
Route::get('sales/afternoon', 'SaleController@afternoon');
Route::post('sales/from-date', 'SaleController@fromDate');
Route::delete('sales/{id}', 'SaleController@destroy');
Route::post('sales/delete-article', 'SaleController@destroyArticle');

// Vista de venta
Route::get('sales/add-item/{barCode}', 'SaleController@addItem');
Route::get('sales/remove-item/{id}', 'SaleController@removeItem');
Route::post('sales', 'SaleController@store');

// Generar codigos de barras
Route::get('generar-codigo/{codigo}', function($codigo){

	// Only the text to draw is required
	$barcodeOptions = ['text' => $codigo];

	// No required options
	$rendererOptions = [];

	// Draw the barcode, // send the headers, and emit the image:
	return Barcode::factory(
	    'code128',
	    'image',
	    $barcodeOptions,
	    $rendererOptions
	)->render();

});

// Auth::routes();
