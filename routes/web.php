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

use App\Http\Controllers\ConfigController;
use App\Http\Controllers\JsonController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\UserController;
use Carbon\Carbon;

Route::any('login', [UserController::class, 'login'])->name('login');

Route::group(array('middleware' => 'auth'), function () {
    Route::get("/", [UserController::class, 'dashboard']);
    Route::get("reset/password/{id}", [UserController::class, 'resetPassword']);
    Route::get('data', [JsonController::class, 'json']);
    Route::get("profile", [UserController::class, 'profile']);
    Route::any("password", [UserController::class, 'changePassword']);
    Route::resource('user', UserController::class);
    Route::get("tax/sync", [TaxController::class, 'sync']);
    Route::post("tax/sync", [TaxController::class, 'doSync']);
    Route::post("tax/restore/{id}", [TaxController::class, 'restore']);
    Route::resource('tax', TaxController::class);
    Route::resource("config", ConfigController::class);

    Route::group(array("prefix" => "export"), function () {
        Route::get("excel/user", [UserController::class, 'exportExcel']);
        Route::get("excel/tax/{exportWhat}", [TaxController::class, 'exportExcel']);
    });

    Route::get("print/{printWhat}/{taxId}", [TaxController::class, 'print']);

    Route::get('asset/image', [SystemController::class, 'image']);
    Route::get('asset/file/{file?}', [SystemController::class, 'file']);
    Route::get('asset/thumbnail/{image?}', [SystemController::class, 'thumbnail']);

    Route::get('about_us', [SystemController::class, 'aboutUs']);
    Route::get('user_manual', [SystemController::class, 'userManual']);

    Route::get("report/{reportWhat}", [TaxController::class, 'report']);
});

Route::group(array("prefix" => "print/preview"), function () {

});

Route::get("fattah", function () {
    $a = $crsSubmitDate = Carbon::parse('03-04-2001')->format('Y-m-d');
    dd($a);
});

Route::get('logout', [UserController::class, 'logout']);
