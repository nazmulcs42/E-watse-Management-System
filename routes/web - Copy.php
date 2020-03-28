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

/**start unathenticate routes

Route::get('/', function () {
    return view('welcome');
});

END unathenticate routes*/

/** start MAP routes*/
Route::get('/test', function () {
    return view('map.test');
});

Route::get('/device', function () {
    return view('map.deviceLocationMap');
});
//Route::get('/input','HouseController@store');
//Route::get('/house', 'HouseController@index')->name('house');

Route::get('/house/input', 'HouseController@create')->name('house.input');
Route::post('/house/input', 'HouseController@store')->name('house.input.submit');

/*Route::get('/cmap', function () {
    return view('map.cmap');
});

Route::get('/gmap', function () {
    return view('map.gmap');
});

Route::get('/kmap', function () {
    return view('map.kmap');
});*/


/** end MAP routes*/

Auth::routes();

/**start user's routes*/

//user login-logout
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/logout', 'auth\LoginController@userLogout')->name('user.logout');

/**END user's routes*/

/**start admin's routes*/

//admin reset passward
Route::get('admin/password/reset', 'admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin/password/email', 'admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/password/reset/{token}', 'admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin/password/reset', 'admin\ResetPasswordController@reset')->name('admin.password.update');

//admin registration 
Route::get('/admin/register', 'admin\RegisterController@showRegistrationForm')->name('admin.register');
Route::post('/admin/register', 'admin\RegisterController@register')->name('admin.register.submit');


//admin login-logout
Route::get('/admin/login', 'admin\LoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'admin\LoginController@login')->name('admin.login.submit');
Route::get('/admin/logout', 'admin\LoginController@logout')->name('admin.logout');
Route::post('/admin/logout', 'admin\LoginController@logout')->name('admin.logout.submit');
Route::get('/admin', 'AdminController@index')->name('admin.dashboard');


/**END admin's routes*/

/**start collector's routes*/

//collector reset passward
Route::get('collector/password/reset', 'collector\ForgotPasswordController@showLinkRequestForm')->name('collector.password.request');
Route::post('collector/password/email', 'collector\ForgotPasswordController@sendResetLinkEmail')->name('collector.password.email');
Route::get('collector/password/reset/{token}', 'collector\ResetPasswordController@showResetForm')->name('collector.password.reset');
Route::post('collector/password/reset', 'collector\ResetPasswordController@reset')->name('collector.password.update');

//collector registration 
Route::get('/collector/register', 'collector\RegisterController@showRegistrationForm')->name('collector.register');
Route::post('/collector/register', 'collector\RegisterController@register')->name('collector.register.submit');


//collector login-logout
Route::get('/collector/login', 'collector\LoginController@showLoginForm')->name('collector.login');
Route::post('/collector/login', 'collector\LoginController@login')->name('collector.login.submit');
Route::get('/collector/logout', 'collector\LoginController@logout')->name('collector.logout');
Route::post('/collector/logout', 'collector\LoginController@logout')->name('collector.logout.submit');
Route::get('/collector', 'CollectorController@index')->name('collector.dashboard');

/**END of collector's routes*/


/**start super_Admin's routes*/

//super_Admin reset passward
Route::get('superadmin/password/reset', 'superadmin\ForgotPasswordController@showLinkRequestForm')->name('superadmin.password.request');
Route::post('superadmin/password/email', 'superadmin\ForgotPasswordController@sendResetLinkEmail')->name('superadmin.password.email');
Route::get('superadmin/password/reset/{token}', 'superadmin\ResetPasswordController@showResetForm')->name('superadmin.password.reset');
Route::post('superadmin/password/reset', 'superadmin\ResetPasswordController@reset')->name('superadmin.password.update');

//super_Admin registration 
Route::get('/superadmin/register', 'superadmin\RegisterController@showRegistrationForm')->name('superadmin.register');
Route::post('/superadmin/register', 'superadmin\RegisterController@register')->name('superadmin.register.submit');


//super_Admin login-logout
Route::get('/superadmin/login', 'superadmin\LoginController@showLoginForm')->name('superadmin.login');
Route::post('/superadmin/login', 'superadmin\LoginController@login')->name('superadmin.login.submit');
Route::get('/superadmin/logout', 'superadmin\LoginController@logout')->name('superadmin.logout');
Route::post('/superadmin/logout', 'superadmin\LoginController@logout')->name('superadmin.logout.submit');
Route::get('/superadmin', 'superadminController@index')->name('superadmin.dashboard');

/**END of super_Admin's routes*/