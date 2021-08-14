<?php

use Illuminate\Support\Facades\Route;

//khai bao cho crud
use App\Http\Controllers\Controller;
use App\Http\Controllers\crudController;
use App\Http\Controllers\ajaxController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/greeting', function () {
    return 'Hello World';
});

// CRUD thuong

Route::get('crud', [crudController::class, 'index']);

Route::post('crud/store', [crudController::class, 'store']);

Route::get('crud/delete/{id}', [crudController::class, 'delete']);

Route::get('crud/edit/{id}', [crudController::class, 'edit']);

Route::post('crud/update/{id}', [crudController::class, 'update']);

// CRUD Ajax

Route::get('crudajax', [ajaxController::class, 'index']);

Route::post('ajax/store', [ajaxController::class, 'store']);

Route::post('ajax/delete', [ajaxController::class, 'delete']);

Route::post('ajax/edit', [ajaxController::class, 'edit']);

Route::post('ajax/finish', [ajaxController::class, 'finish']);