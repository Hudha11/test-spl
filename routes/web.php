<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route manager
Route::view('manager/user/index', 'manager.user.index')->name('manager.user.index');
Route::view('manager/spl/index', 'manager.spl.index')->name('manager.spl.index');
Route::view('manager/approval/index', 'manager.approval.index')->name('manager.approval.index');
