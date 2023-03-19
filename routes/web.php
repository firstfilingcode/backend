<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\MapsController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\AjaxController;

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

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('view:clear');
    // $exitCode = Artisan::call('config:cache');
});


  Route::get('/', function () {
        return view('admin.auth.login');
    })->name('admin.auth.login');    