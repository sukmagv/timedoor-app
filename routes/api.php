<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\RatingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', [BookController::class,'index'])->name('books.index');
Route::get('/authors/top', [AuthorController::class,'topTen'])->name('authors.top');
Route::get('/rating/create', [RatingController::class,'create'])->name('ratings.create');
Route::post('/rating', [RatingController::class,'store'])->name('ratings.store');
