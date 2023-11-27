<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;

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

// Route::get('/brand', function () {
//     return view('hello word');
// });
// Route::post('/', function () {
//     return view('welcome');
// });
// Route::get('admin/login', [AuthController::class, 'login'])->route("admin.login");
Route::get('/brand', [BrandController::class, 'index']);
