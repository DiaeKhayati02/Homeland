<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\Props\PropertiesController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\Props\PropertiesController::class, 'index'])->name('home');
Route::get('props/prop-details/{id}', [App\Http\Controllers\Props\PropertiesController::class, 'single'])->name('single.prop');

//inserting requests
Route::post('props/prop-details/{id}', [App\Http\Controllers\Props\PropertiesController::class, 'insertRequests'])->name('insert.request');

//saving properties

Route::post('props/saved-props/{id}', [App\Http\Controllers\Props\PropertiesController::class, 'saveProps'])->name('save.prop');

//displaying props by rent and buy
Route::get('props/type/Buy', [App\Http\Controllers\Props\PropertiesController::class, 'propsBuy'])->name('buy.prop');
Route::get('props/type/Rent', [App\Http\Controllers\Props\PropertiesController::class, 'propsRent'])->name('rent.prop');


//displaying props by home type
Route::get('props/home-type/{hometype}', [App\Http\Controllers\Props\PropertiesController::class, 'displayByHomeType'])->name('display.prop.hometype');

//displaying props by price asc and desc
Route::get('props/price-asc', [App\Http\Controllers\Props\PropertiesController::class, 'priceAsc'])->name('price.asc.prop');

//displaying props by price asc and desc
Route::get('props/price-desc', [App\Http\Controllers\Props\PropertiesController::class, 'priceDesc'])->name('price.desc.prop');

//display contact and about pages
Route::get('contact', [App\Http\Controllers\Props\HomeController::class, 'contact'])->name('contact');
Route::get('about', [App\Http\Controllers\Props\HomeController::class, 'about'])->name('about');

//displaying user requests
Route::get('users/all-requests', [App\Http\Controllers\Props\UsersController::class, 'sllRequests'])->name('all.requests');
