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

//Route::get('tasi', 'FrontendController@tasi');
//Route::get('adress', 'FrontendController@addressKayit');

Route::get('clear', function (){
   // $exitCode = Artisan::call('cache:clear');
});

Route::get('admin/giris', 'AdminController@loginPage');
Route::post('admin/giris', 'AdminController@login');

Route::get('calisan/giris', 'WorkerController@loginPage');
Route::post('calisan/giris', 'WorkerController@login');
Route::post('sifreyiyenile', 'FrontendController@passwordReset');

Route::get('user/me', 'UserController@me');
Route::get('api/menu', 'FrontendController@menu');
Route::post('user/sepet', 'UserController@sepet');
Route::post('user/login', 'UserController@login');
Route::get('user/sepetDel/{id}', 'UserController@sepetDeleteItem');
Route::get('addressList', 'FrontendController@getAddress');
Route::post('user/register', 'UserController@register');
Route::post('rezervasyon/add', 'FrontendController@registerRezervasyon');
Route::get('cart/cupon', 'FrontendController@getCupon');

Route::middleware(['worker'])->group(function (){
    Route::get('calisan', 'WorkerController@index');
    Route::get('rezervasyon/list', 'RezervasyonController@getRezervasyon');
    Route::get('order/list', 'OrderController@getOrder');
    Route::get('order/fis/{id}', 'OrderController@orderFis');
    Route::post('order/update', 'OrderController@update');
    Route::get('kurye/list', 'AdminController@allKurye');
    Route::get('calisan/cikis-yap', 'WorkerController@logout');
    Route::post('rezervasyon/update', 'RezervasyonController@update');
    Route::get('worker/me', 'WorkerController@me');
    Route::get('day/zrapor', 'FrontendController@dayzrapor');
    Route::get('z-rapor', 'OrderController@zRapor');

});

Route::middleware(['user'])->group(function(){
    Route::get('user/orders', 'UserController@orders');
    Route::get('kullanici/cikis', 'UserController@logout');
    Route::post('user/update', 'UserController@update');
    Route::post('user/payment', 'FrontendController@payment');
});

Route::middleware(['admin'])->group(function () {
    Route::get('admin', 'AdminController@home');
    Route::get('data/admin', 'AdminController@adminData');
    Route::get('admin/Logout', 'AdminController@logout');

    Route::post('admin/api/newProduct', 'ProductController@create');
    Route::get('admin/api/allWorker', 'WorkerController@list');
    Route::get('admin/api/user/all', 'AdminController@getAllUser');
    Route::get('admin/api/order', 'AdminController@getFullOrder');
    Route::get('admin/api/thisdayorder', 'AdminController@thisDayOrder');
    Route::get('admin/api/thismonthorder', 'AdminController@thisMonthOrder');
    Route::get('admin/api/thisdaypayment', 'AdminController@thisDayPayment');
    Route::get('admin/api/thismonthpayment', 'AdminController@thisMonthPayment');
    Route::get('admin/api/iptalorder', 'AdminController@iptalOrder');
    Route::get('admin/api/iptalordermonth', 'AdminController@iptalOrderMonth');
    Route::get('admin/api/thisdaymany', 'AdminController@thisDayMany');
    Route::get('admin/api/thismonthmany', 'AdminController@thisMonthMany');
    Route::get('admin/api/allCategory', 'AdminController@allCategory');
    Route::get('admin/api/allKurye', 'AdminController@allKurye');
    Route::post('admin/api/newKurye', 'KuryeController@create');
    Route::get('admin/api/alluser', 'AdminController@userCount');
    Route::get('admin/api/userthismonth', 'AdminController@userThisMonth');
    Route::get('admin/api/userthisyear', 'AdminController@userThisYear');
    Route::get('admin/api/allrezervasyon', 'AdminController@allRezervasyonCount');
    Route::get('admin/api/rezervasyon/thisday', 'AdminController@allRezervasyonDayCount');
    Route::get('admin/api/rezervasyon/thismonth', 'AdminController@allRezervasyonMonthCount');
    Route::get('admin/api/rezervasyon/thisyear', 'AdminController@allRezervasyonYearCount');
    Route::get('admin/api/kurye/del/{id}', 'KuryeController@delete');
    Route::get('admin/api/product/del/{id}', 'ProductController@delete');
    Route::get('admin/api/delCategory/{id}', 'CategoryController@delete');
    Route::post('admin/api/newCalisan', 'WorkerController@create');
    Route::post('admin/api/updatecalisan', 'WorkerController@update');
    Route::get('admin/api/delCalisan/{id}', 'WorkerController@delete');
    Route::get('admin/admin/api/orderDetay/year', 'OrderController@thisYear');
    Route::get('admin/api/orderDetay/month', 'OrderController@thisMonth');
    Route::get('admin/api/orderDetay/week', 'OrderController@thisWeek');
    Route::get('admin/api/orderDetay/day', 'OrderController@thisDay');
    Route::get('admin/api/allproduct', 'ProductController@allProduct');
    Route::post('admin/api/newCategory', 'CategoryController@create');
    Route::post('admin/api/category/update', 'CategoryController@update');
    Route::post('category/list', 'CategoryController@list');
    Route::post('product/list', 'ProductController@list');
    Route::post('product/update', 'ProductController@update');
    Route::get('store/list', 'StoreController@list');
    Route::post('store/create', 'StoreController@create');
    Route::delete('store/delete/{id}', 'StoreController@delete');
    Route::post('store/update', 'StoreController@update');
    Route::post('site/update', 'AdminController@siteUpdate');
    Route::get('site/durum', 'AdminController@siteData');
    Route::get('admin/admin/api/write/order/data', 'Productcontroller@pdfList');
    Route::get('admin/admin/api/write/order/data/excel', 'ProductController@excelList');
    Route::get('admin/admin/api/write/kurye/data', 'KuryeController@pdfList');
    Route::get('admin/api/write/kurye/data', 'KuryeController@list');
    Route::get('rapor/zrapor', 'FrontendController@zrapor');
    Route::get('day/zrapor', 'FrontendController@dayzrapor');
    Route::get('user/excel', 'AdminController@getAllUserExcel');

    Route::get('data/get/store', 'StoreController@getStoreData');

    Route::get('/{any}/{two}', 'AdminController@home')->where('any', '.*');
});


Route::get('/{any}', 'FrontendController@home')->where('any', '.*');