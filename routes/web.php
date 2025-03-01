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
Route::post('admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'checkLogin'])->name('check.login');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function(){

Route::get('/index', [App\Http\Controllers\Admins\AdminsController::class, 'index'])->name('admins.dashboard');
Route::get('/all-admins', [App\Http\Controllers\Admins\AdminsController::class, 'allAdmins'])->name('admins.admins');
Route::get('/create-admins', [App\Http\Controllers\Admins\AdminsController::class, 'createAdmins'])->name('admins.create');
Route::post('/create-admins', [App\Http\Controllers\Admins\AdminsController::class, 'storeAdmins'])->name('admins.store');

Route::get('/all-hometypes', [App\Http\Controllers\Admins\AdminsController::class, 'allHomeTypes'])->name('admins.hometypes');
Route::get('/create-hometypes', [App\Http\Controllers\Admins\AdminsController::class, 'createHomeTypes'])->name('hometypes.create');
Route::post('/create-hometypes', [App\Http\Controllers\Admins\AdminsController::class, 'storeHomeTypes'])->name('hometypes.store');


Route::get('/edit-hometypes/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'editHomeTypes'])->name('hometypes.edit');
Route::post('/update-hometypes/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateHomeTypes'])->name('hometypes.update');

Route::get('/delete-hometypes/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteHomeTypes'])->name('hometypes.delete');


Route::get('/all-requests', [App\Http\Controllers\Admins\AdminsController::class, 'Requests'])->name('requests.all');

Route::get('/all-props', [App\Http\Controllers\Admins\AdminsController::class, 'allProps'])->name('props.all');

Route::get('/create-props', [App\Http\Controllers\Admins\AdminsController::class, 'createProps'])->name('props.create');
Route::post('/create-props', [App\Http\Controllers\Admins\AdminsController::class, 'storeProps'])->name('props.store');

Route::get('/create-gallery', [App\Http\Controllers\Admins\AdminsController::class, 'createGallery'])->name('gallery.create');
Route::post('/create-gallery', [App\Http\Controllers\Admins\AdminsController::class, 'storeGallery'])->name('gallery.store');


});