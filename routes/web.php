<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\RatingController;

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


Route::get('/', [BookController::class,'index'])->name('books.index');
Route::get('/authors/top', [AuthorController::class,'topTen'])->name('authors.top');
Route::get('/rating/create', [RatingController::class,'create'])->name('ratings.create');
Route::post('/rating', [RatingController::class,'store'])->name('ratings.store');

// AJAX
Route::get('/authors/{author}/books', [RatingController::class,'booksByAuthor'])->name('authors.books');


if (file_exists(base_path('routes/api.php'))) {
    require base_path('routes/api.php');
}