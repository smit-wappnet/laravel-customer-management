<?php

use App\Http\Controllers\CustomerController;
use App\Models\Customer;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [CustomerController::class,'index'])->name("home");
Route::post('/', [CustomerController::class,'store']);
Route::get('/delete/{customer}', [CustomerController::class, 'destroy'])->name("delete");
Route::get('/edit/{customer}', [CustomerController::class, 'edit'])->name("edit");
Route::post('/edit/{customer}', [CustomerController::class, 'update'])->name("update");

Route::get('table', [CustomerController::class,'getData'])->name('table');