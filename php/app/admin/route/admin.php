<?php

use think\facade\Route;
use \app\admin\middleware\Demo;
use \app\admin\middleware\Auth;

Route::get('demo', 'demo/index')->middleware([Auth::class,Demo::class]);

Route::post('account/login', 'account/login')->middleware(\app\admin\middleware\Account::class);

Route::post('account/info', 'account/info')->middleware(\app\admin\middleware\Auth::class)->allowCrossDomain();

Route::resource('prod_cate', 'ProductCategory')->middleware(\app\admin\middleware\ProductCategory::class);
// Route::resource('prod', 'Product')->middleware(\app\admin\middleware\Product::class);
Route::group('prod', function () {
    Route::post('save', 'Product/save');
    Route::post('update', 'Product/update');
})->middleware(\app\admin\middleware\Product::class);

// Route::group('Demo', function () {
//     Route::post('index', 'Demp/index');
// })->middleware(\app\admin\middleware\Demo::class);


Route::resource('prod_specs_name', 'ProductSpecsName')->middleware(\app\admin\middleware\ProductSpecsName::class);
Route::resource('prod_specs_value', 'ProductSpecsValue')->middleware(\app\admin\middleware\ProductSpecsValue::class);
