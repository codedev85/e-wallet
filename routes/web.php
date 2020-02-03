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

// Route::get('/','HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');

Route::middleware(['auth','logs'])->group(function () {


      
        Route::post('/pay', [
            'uses' => 'PaymentController@redirectToGateway',
            'as' => 'pay'
        ]);
    

        Route::get('/create-wallet/', 'WalletController@walletCreate');

        Route::POST('/load-wallet/','WalletController@loadWallet');

        Route::get('/payment/','WalletController@payment')->name('payment');


        Route::get('/create-product/','ProductController@createProduct')->middleware('admin');

        Route::POST('/add-product/','ProductController@addProduct')->middleware('admin');

        Route::get('/buy-product/', 'ProductController@buyProduct');

        Route::get('/purchase/{id}', 'ProductController@purchaseProduct');

        Route::post('/card-payment/','ProductController@cardPayment');

        Route::get('/add-card/','CardController@addCard')->middleware('admin');

        Route::post('/post-card/','CardController@postCard')->middleware('admin');

        Route::get('/add-role/','RoleController@addRole')->middleware('admin');

        Route::post('/post-role/','RoleController@postRole')->middleware('admin');

        Route::get('/create-admin/','RoleController@createAdmin')->middleware('admin');

        Route::post('/post-admin/','RoleController@postAdmin')->middleware('admin');

        Route::get('/all-user/','RoleController@allAdmin')->middleware('admin');



});


