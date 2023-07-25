<?php

use think\facade\Route;

Route::get('demo','demo/index');

Route::post('account/login','account/login')->middleware(\app\admin\middleware\Account::class);

Route::post('account/info','account/info')->middleware(\app\admin\middleware\Auth::class)->allowCrossDomain();

Route::resource('prod_cate', 'ProductCategory')->middleware(\app\admin\middleware\ProductCategory::class);