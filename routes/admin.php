<?php
Route::group(["prefix" => "admin"], function () {

    Auth::routes();
    
    Route::group(['middleware' => ['auth', "permission:admin.index"]], function () {

        // Trang chủ admin
        Route::get('/dashboard', 'DashboardController@index')->name("admin.dashboard.index")->middleware("permission:admin.index");

         // user app
        resourceAdmin('users', 'UserController', 'user');

        // Vai trò, quyền
        resourceAdmin('roles', 'RoleController', 'role');

        // student 2 la permission
        resourceAdmin('students', 'StudentsController', 'students');

        //danh sach lop
        resourceAdmin('classes', 'ClassesController', 'classes');

    });

});