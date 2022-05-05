<?php

use Illuminate\Support\Facades\Route;

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

// Front end routes
Route::group(array('namespace' => '\App\Http\Controllers'), function() {
    Route::get('/', 'FrontEndController@index')->name('index');
    Route::get('/hospitals', 'FrontEndController@hospitals')->name('hospitals');
    Route::get('/hospital/{slug}/', 'FrontEndController@hospitalsDetail')->name('hospital_details');

    Route::get('/doctors/', 'FrontEndController@doctorsView')->name('doctors');
    Route::get('/doctor/{slug}/', 'FrontEndController@DoctorsDetail')->name('doctor_details');

    Route::get('/vaccines', 'FrontEndController@vaccines')->name('vaccines');
    Route::get('/vaccines/{slug}', 'FrontEndController@vaccine_detail')->name('vaccine_detail');

    Route::get('/vendor-register', 'FrontEndController@vendorRegisterView')->name('vendor_register_view');
    Route::post('/vendor-register', 'FrontEndController@vendorRegister')->name('vendor_register');

    // e-commerce routes
    Route::get('/add-to-cart/{slug}', 'CartController@addToCart')->name('add_to_cart');
    Route::get('/checkout', 'CartController@checkoutView')->middleware('is_cart_empty')->name('checkout_view');
    Route::post('/checkout', 'CartController@checkoutProcess')->name('checkout_process');

    Route::get('/checkout/{orderId}/processing', 'CartController@orderComplete')->name('order-complete');


});


// back end routes
Route::group(array('namespace' => '\App\Http\Controllers\Admin', 'prefix' => '/dashboard'), function() {
    Route::group(['middleware' => ['auth', 'role']], function() {

        Route::resource('/user', 'UserController')->middleware('role');
        Route::put('/user/{id}/status', 'UserController@status')->name('UserStatus');

        Route::resource('/hospital', 'HospitalsController');
        Route::get('/my-hospital', 'HospitalsController@vendor_hospital_view')->name('vendor_hospital_view');
        Route::post('/my-hospital/create', 'HospitalsController@vendor_hospital_create')->name('vendor_hospital_create');
        Route::put('/my-hospital/update', 'HospitalsController@vendor_hospital_update')->name('vendor_hospital_update');
        Route::put('/hospital/{id}/status', 'HospitalsController@status')->name('HospitalStatus');

        Route::resource('/service', 'ServicesController');

        Route::resource('/doctor', 'DoctorsController');

        Route::resource('/vaccine', 'VaccinesController');

        Route::resource('/order', 'OrdersController');
        Route::put('/order/status/{order}', 'OrdersController@orderStatusUpdate')->name('update_order_status');

    });
    Route::resource('/order', 'OrdersController');
    // customer role route outside middleware group
    Route::get('/profile', 'UserController@vendorProfile')->name('vendor_profile_view');
});


Route::get('/dashboard', function () {
    return view('admin/dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
