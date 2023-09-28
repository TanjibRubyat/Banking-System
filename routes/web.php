<?php

use App\Http\Controllers\DepositController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WithdrawalController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::get('/transactions',function(){
    return view('transactions');
})->middleware(['auth'])->name('transactions');

Route::get('/withdrawal-transaction',function(){
    return view('withdrawal-transaction');
})->middleware(['auth'])->name('withdrawal.transactions');


Route::get('/deposit',[DepositController::class,'index'])->middleware(['auth'])->name('deposit');
Route::post('/deposit',[DepositController::class,'store'])->middleware(['auth'])->name('create-deposit');

Route::get('/withdrawal',[WithdrawalController::class,'index'])->middleware(['auth'])->name('withdrawal');
Route::post('/withdrawal',[WithdrawalController::class,'store'])->middleware(['auth'])->name('create-withdrawal');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
