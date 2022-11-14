<?php
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::apiResource('/employees', 'Api\EmployeeController');
Route::apiResource('/customer', 'Api\CustomerController');
Route::apiResource('/supplier', 'Api\SupplierController');
Route::apiResource('/category', 'Api\CategoryController');
Route::apiResource('/product', 'Api\ProductController');
Route::apiResource('/expense', 'Api\ExpenseController');

Route::Post('/salary/paid/{id}', 'Api\SalaryController@paid');
Route::Get('/salary/view/{id}', 'Api\SalaryController@viewSalary');
Route::Get('/edit/sallery/{id}', 'Api\SalaryController@editSalery');
Route::post('/sallery/update/{id}', 'Api\SalaryController@salaryUpdate');
Route::post('/stock/update/{id}', 'Api\ProductController@stockUpdate');



Route::Get('/sallary', 'Api\SalaryController@allsalary');
Route::Get('/getting/product/{id}', 'Api\PosController@GetProducts');



Route::Get('/AddToCart/{id}', 'Api\CartController@AddToCart');
Route::Get('/cart/product/', 'Api\CartController@cartProduct');
Route::Get('/remove/cart/{id}', 'Api\CartController@removecart');

Route::Get('/increment/{id}', 'Api\CartController@increment');
Route::Get('/decrement/{id}', 'Api\CartController@decrement');


Route::Get('/vats/', 'Api\CartController@vats');
Route::Post('/orderdone/', 'Api\PosController@orderdone');

Route::Get('/orders/', 'Api\OrderController@todayOrder');

Route::Get('/order/details/{id}', 'Api\OrderController@orderDeatils');
Route::Get('/order/order_details/{id}', 'Api\OrderController@OrderDeatilAll');


Route::Post('/search/order/', 'Api\OrderController@searchDateOrder');


//today Sale 

Route::Get('/today/sell/', 'Api\PosController@todaysale');
Route::Get('/today/income/', 'Api\PosController@todayincome');

Route::Get('/today/stockout/', 'Api\PosController@stockout');




Route::Get('/today/due/', 'Api\PosController@todaydue');
Route::Get('/today/expense/', 'Api\PosController@todayexpense');


