<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route manager
Route::view('manager/user/index', 'manager.user.index')->name('manager.user.index');
Route::view('manager/spl/index', 'manager.spl.index')->name('manager.spl.index');
Route::view('manager/approval/index', 'manager.approval.index')->name('manager.approval.index');

// Route supervisor
Route::view('supervisor/spl/index', 'supervisor.spl.index')->name('supervisor.spl.index');

// Route admin
Route::view('admin/user/index', 'admin.user.index')->name('admin.user.index');
Route::view('admin/approval/index', 'admin.approval.index')->name('admin.approval.index');

// Route karyawan
Route::view('karyawan/lembur/index', 'karyawan.lembur.index')->name('karyawan.lembur.index');
