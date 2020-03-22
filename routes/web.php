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

Route::any('login', 'UserController@login');
Route::any("password/reset/{token}", 'UserController@newPassword');
Route::any("password/lost/{token?}", 'UserController@lostPassword');
Route::any("activate/{id}", 'UserController@activation');

Route::group(array('middleware' => 'auth'), function () {
    Route::get("/", "UserController@dashboard");
    Route::get("resend/activation/{id}", "UserController@resendActivation");
    Route::get("reset/password/{id}", "UserController@resetPassword");
    Route::get('data', 'JsonController@json');
    Route::get("users", 'UserController@index');
    Route::get("profile", 'UserController@profile');
    Route::any("password", 'UserController@changePassword');
    Route::get("owner", 'OwnerController@index');

    Route::group(array("prefix" => "create"), function () {
        Route::get("user", 'UserController@create');
    });

    Route::group(array("prefix" => "store"), function () {
        Route::post("config/{tab}", 'ConfigController@store');
        Route::post("user", 'UserController@store');
    });

    Route::group(array("prefix" => "edit"), function () {
        Route::get("config/{tab}", 'ConfigController@edit');
        Route::get("user/{id}", 'UserController@edit');
    });

    Route::group(array("prefix" => "update"), function () {
        Route::post("config/{tab}", 'ConfigController@update');
        Route::post("user/{id}", 'UserController@update');
    });

    Route::group(array("prefix" => "show"), function () {
        Route::get("user/{id}", 'UserController@show');
    });

    Route::group(array("prefix" => "delete"), function () {
        Route::delete("config/{tab}", 'ConfigController@delete');
        Route::delete("user/{id}", 'UserController@delete');
    });

    Route::group(array("prefix" => "export"), function () {
        Route::get("excel/user", 'UserController@exportExcel');
    });

    Route::group(array("prefix" => "print"), function () {
        Route::get("assessment/item/{id}", 'AssessmentController@printItem');
    });

    Route::get('asset/image', 'SystemController@image');
    Route::get('asset/file/{file?}', 'SystemController@file');
    Route::get('asset/thumbnail/{image?}', 'SystemController@thumbnail');

    Route::get('about_us', 'SystemController@aboutUs');
    Route::get('user_manual', 'SystemController@userManual');
});

Route::group(array("prefix" => "print/preview"), function () {
    Route::get("assessment/item/{id}", 'AssessmentController@printPreviewItem');
});

Route::get('logout', 'UserController@logout');
