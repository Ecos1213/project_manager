<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('getAllProjects', [ProjectController::class, 'getAllProjects']);
Route::get('insertNewProject', [ProjectController::class, 'insertProject']);
Route::get('insertThirteenProject', [ProjectController::class, 'insertThirteenProject']);
Route::get('insertThirteenCity', [ProjectController::class, 'insertThirteenCity']);
Route::get('insertThirteenCompany', [ProjectController::class, 'insertThirteenCompany']);
Route::get('insertThirteenUser', [ProjectController::class, 'insertThirteenUser']);
Route::get('updateProject', [ProjectController::class, 'updateProject']);
Route::get('deleteProject', [ProjectController::class, 'deleteProject']);
