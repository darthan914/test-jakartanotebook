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

Route::get('/', "Frontend\HomeController@index")->name('home');
Route::get('/home', "Frontend\HomeController@index")->name('home');

Route::get('login', "Frontend\AuthController@login")->name('login')->middleware('guest');
Route::post('doLogin', "Frontend\AuthController@doLogin")->name('doLogin')->middleware('guest');
Route::get('register', "Frontend\AuthController@register")->name('register')->middleware('guest');
Route::post('doRegister', "Frontend\AuthController@doRegister")->name('doRegister')->middleware('guest');
Route::get('logout', "Frontend\AuthController@logout")->name('logout')->middleware('auth');

Route::get('product', "Frontend\ProductController@index")->name('product')->middleware('auth');
Route::post('product/store', "Frontend\ProductController@store")->name('product.store')->middleware('auth');

Route::get('prepaid', "Frontend\PrepaidController@index")->name('prepaid')->middleware('auth');
Route::post('prepaid/store', "Frontend\PrepaidController@store")->name('prepaid.store')->middleware('auth');

Route::get('order', "Frontend\OrderController@index")->name('order')->middleware('auth');
Route::get('order/success', "Frontend\OrderController@success")->name('success')->middleware('auth');
Route::get('order/payment', "Frontend\OrderController@payment")->name('payment')->middleware('auth');
Route::post('order/doPayment', "Frontend\OrderController@doPayment")->name('doPayment')->middleware('auth');


