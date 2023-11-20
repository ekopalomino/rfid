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
    return view('apps.pages.login');
});

Auth::routes(['register' => false]);
Route::group(['prefix' => 'apps', 'middleware' => ['auth']], function() {
    Route::get('login/locked','Auth\LoginController@locked')->name('login.locked');
    Route::post('login/locked','Auth\LoginController@unlock')->name('login.unlock'); 
});
Route::group(['prefix' => 'apps', 'middleware' => ['auth.lock']], function() {
    
    Route::resource('dashboard','Apps\DashboardController');
    /*-----------------------User Management-----------------------------*/
    Route::get('users','Apps\UserManagementController@userIndex')->name('user.index');
    Route::post('users/create','Apps\UserManagementController@userStore')->name('user.store');
    Route::get('users/edit/{id}','Apps\UserManagementController@userEdit')->name('user.edit');
    Route::get('users/show/{id}','Apps\UserManagementController@userShow')->name('user.show');
    Route::post('users/update/{id}','Apps\UserManagementController@userUpdate')->name('user.update');
    Route::post('users/suspend/{id}','Apps\UserManagementController@userSuspend')->name('user.suspend');
    Route::post('users/delete/{id}','Apps\UserManagementController@userDestroy')->name('user.destroy');
    Route::get('users/profile', 'Apps\UserManagementController@userProfile')->name('user.profile');
    Route::post('users/profile/avatar', 'Apps\UserManagementController@updateAvatar')->name('user.avatar');
    Route::post('users/profile/password', 'Apps\UserManagementController@updatePassword')->name('user.password');
    Route::get('users/roles','Apps\UserManagementController@roleIndex')->name('role.index');
    Route::get('users/roles/create','Apps\UserManagementController@roleCreate')->name('role.create');
    Route::post('users/roles/store','Apps\UserManagementController@roleStore')->name('role.store');
    Route::get('users/roles/edit/{id}','Apps\UserManagementController@roleEdit')->name('role.edit');
    Route::get('users/roles/show/{id}','Apps\UserManagementController@roleShow')->name('role.show');
    Route::post('users/roles/update/{id}','Apps\UserManagementController@roleUpdate')->name('role.update');
    Route::post('users/roles/delete/{id}','Apps\UserManagementController@roleDestroy')->name('role.destroy');
    
    Route::get('users/log-activities','Apps\LogActivityController@index')->name('user.log');
    /*-----------------------End User Management-----------------------------*/

    /*-----------------------Config Management-----------------------------*/
    Route::get('configuration/branch','Apps\ConfigurationController@warehouseIndex')->name('warehouse.index');
    Route::post('configuration/branch/create','Apps\ConfigurationController@warehouseStore')->name('warehouse.store');
    Route::get('configuration/branch/edit/{id}','Apps\ConfigurationController@warehouseEdit')->name('warehouse.edit');
    Route::post('configuration/branch/update/{id}','Apps\ConfigurationController@warehouseUpdate')->name('warehouse.update');
    Route::post('configuration/branch/delete/{id}','Apps\ConfigurationController@warehouseDestroy')->name('warehouse.destroy');
    Route::get('configuration/location','Apps\ConfigurationController@locationIndex')->name('location.index');
    Route::post('configuration/location/create','Apps\ConfigurationController@locationStore')->name('location.store');
    Route::get('configuration/location/edit/{id}','Apps\ConfigurationController@locationEdit')->name('location.edit');
    Route::post('configuration/location/update/{id}','Apps\ConfigurationController@locationUpdate')->name('location.update');
    Route::get('configuration/department','Apps\ConfigurationController@ukerIndex')->name('uker.index');
    Route::post('configuration/department/create','Apps\ConfigurationController@ukerStore')->name('uker.store');
    Route::get('configuration/department/edit/{id}','Apps\ConfigurationController@ukerEdit')->name('uker.edit');
    Route::get('configuration/department/show/{id}','Apps\ConfigurationController@ukerShow')->name('uker.show');
    Route::post('configuration/department/update/{id}','Apps\ConfigurationController@ukerUpdate')->name('uker.update');
    Route::post('configuration/department/delete/{id}','Apps\ConfigurationController@ukerDestroy')->name('uker.destroy');

    /*-----------------------End Config Management-----------------------------*/

    /*-----------------------Product Management--------------------------------*/
    Route::get('products/categories','Apps\ProductManagementController@categoryIndex')->name('product-cat.index');
    Route::post('products/categories/create','Apps\ProductManagementController@categoryStore')->name('product-cat.store');
    Route::get('products/categories/edit/{id}','Apps\ProductManagementController@categoryEdit')->name('product-cat.edit');
    Route::post('products/categories/update/{id}','Apps\ProductManagementController@categoryUpdate')->name('product-cat.update');
    Route::post('products/categories/delete/{id}','Apps\ProductManagementController@categoryDestroy')->name('product-cat.destroy');
    Route::get('products','Apps\ProductManagementController@productIndex')->name('product.index');
    Route::get('products/create','Apps\ProductManagementController@productCreate')->name('product.create');
    Route::post('products/store','Apps\ProductManagementController@productStore')->name('product.store');
    Route::get('products/show/{id}','Apps\ProductManagementController@productShow')->name('product.show');
    Route::get('products/show/print/{id}','Apps\ProductManagementController@productPdf')->name('product.pdf');
    Route::get('products/edit/{id}','Apps\ProductManagementController@productEdit')->name('product.edit');
    Route::post('products/update/{id}','Apps\ProductManagementController@productUpdate')->name('product.update');
    Route::post('products/delete/{id}','Apps\ProductManagementController@productDestroy')->name('product.destroy');
    Route::get('asset-movement','Apps\ProductManagementController@movementIndex')->name('movement.index');
    /*-----------------------End Product Management--------------------------------*/
});
