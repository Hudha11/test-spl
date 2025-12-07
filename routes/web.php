<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('manager/user/index', 'manager.user.index')->name('manager.user.index');
