<?php

use think\facade\Route;

Route::get('demo','demo/index');

Route::post('login','account/login')->middleware(\app\admin\middleware\Account::class);