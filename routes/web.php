<?php
use App\Http\Controllers\Props\UsersController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\Props\PropertiesController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\Props\PropertiesController::class, 'index'])->name('home');
Route::get('props/prop-details/{id}', [App\Http\Controllers\Props\PropertiesController::class, 'single'])->name('single.prop');

//inserting requests
Route::group(['prefix' => 'props'], function(){
    Route::post('prop-details/{id}', [App\Http\Controllers\Props\PropertiesController::class, 'insertRequests'])->name('insert.request');

    //saving properties
    
    Route::post('saved-props/{id}', [App\Http\Controllers\Props\PropertiesController::class, 'saveProps'])->name('save.prop');
    
    //displaying props by rent and buy
    Route::get('type/Buy', [App\Http\Controllers\Props\PropertiesController::class, 'propsBuy'])->name('buy.prop');
    Route::get('type/Rent', [App\Http\Controllers\Props\PropertiesController::class, 'propsRent'])->name('rent.prop');
    
    
    //displaying props by home type
    Route::get('home-type/{hometype}', [App\Http\Controllers\Props\PropertiesController::class, 'displayByHomeType'])->name('display.prop.hometype');
    
    //displaying props by price asc and desc
    Route::get('price-asc', [App\Http\Controllers\Props\PropertiesController::class, 'priceAsc'])->name('price.asc.prop');
    
    //displaying props by price asc and desc
    Route::get('price-desc', [App\Http\Controllers\Props\PropertiesController::class, 'priceDesc'])->name('price.desc.prop');


    //searching for props
    Route::any('search', [App\Http\Controllers\Props\PropertiesController::class, 'searchProps'])->name('search.prop');

});


//display contact and about pages
Route::get('contact', [App\Http\Controllers\Props\HomeController::class, 'contact'])->name('contact');
Route::get('about', [App\Http\Controllers\Props\HomeController::class, 'about'])->name('about');

Route::group(['prefix' => 'users'], function(){
//displaying user requests
Route::get('all-requests', [App\Http\Controllers\Users\UsersController::class, 'allRequests'])->name('all.requests');
Route::get('all-saved-props', [App\Http\Controllers\Users\UsersController::class, 'allSavedProps'])->name('all.saved.props');
});

Route::get('admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'viewLogin'])->name('view.login');
Route::post('admin/check-login', [App\Http\Controllers\Admins\AdminsController::class, 'checkLogin'])->name('check.login');
Route::post('admin/index', [App\Http\Controllers\Admins\AdminsController::class, 'index'])->name('admins.dashboard');
