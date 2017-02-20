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

//Route::get('slack/files', MainController::class.'@deletSlackFile');

Route::get('/', MainController::class.'@index')->name('home');
Route::get('/contact', MainController::class.'@getContact')->name('contact');
Route::post('/contact', MainController::class.'@postContact')->name('post.contact');

Route::get('/register', MainController::class.'@getRegister')->name('register');
Route::post('/register', MainController::class.'@postRegister')->name('post.register');

Route::get('/login', MainController::class.'@getLogin')->name('front.login');
Route::post('/login', MainController::class.'@postLogin')->name('front.post.login');
Route::get('logout', AdminController::class.'@logout')->name('logout');

Route::get('/cart', MainController::class.'@getCart')->name('cart');
Route::get('/checkout', MainController::class.'@getCheckout')->name('checkout');
Route::post('/checkout', MainController::class.'@postCheckout')->name('post.checkout');
Route::get('/validated', MainController::class.'@validated')->name('thanks');


Route::resource('shop', ProductController::class, ['only' => ['show', 'index']]);
Route::resource('paniers', BasketController::class, ['only' => ['show', 'index']]);


Route::group(['prefix' => 'shop'], function(){
    Route::get('fruits', ProductController::class.'@index')->name('fruits');
    Route::get('vegetables', ProductController::class.'@index')->name('vegetables');
    Route::post('/', ProductController::class.'@search')->name('search');
    Route::post('cart/add', ProductController::class.'@addToCart');
    Route::post('cart/update', ProductController::class.'@updateCart');
    Route::post('cart/remove', ProductController::class.'@removeFromCart');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/infos', UserController::class.'@getInfos')->name('infos');
    Route::post('/infos', UserController::class.'@postInfos')->name('post.infos');
    Route::resource('commandes', OrderController::class, ['only' => ['show', 'index']]);
});


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('dashboard', AdminController::class.'@dashboard')->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class, ['except' => ['show']]);
    Route::resource('baskets', BasketController::class, ['except' => ['show']]);
    Route::resource('orders', OrderController::class);
    Route::resource('config', ConfigController::class);
    
});
