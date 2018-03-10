<?php
Route::group(["prefix" => "admin"], function () {

    Auth::routes();
    
    Route::group(['middleware' => ['auth', "permission:admin.index"]], function () {

        // Trang chủ admin
        Route::get('/dashboard', 'DashboardController@index')->name("admin.dashboard.index")->middleware("permission:admin.index");

        Route::get('/', 'DashboardController@index')->name("admin.dashboard.index")->middleware("permission:admin.index");

         // Cố đông
        resourceAdmin('users', 'UserController', 'user');

        // Vai trò, quyền
        resourceAdmin('roles', 'RoleController', 'role');

        // Hệ thống
        resourceAdmin('system', 'SystemController', 'system', 'system', ['show', 'index', 'create', 'destroy']);
    });

});