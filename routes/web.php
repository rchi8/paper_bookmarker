<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\BookmarkController;

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

//Route::get('/', function () { return view('contents.index'); });
Route::get('/', [ViewController::class, 'index'])->name('index');
Route::get('/new', [ViewController::class, 'new'])->name('new');
Route::get('/search', [ViewController::class, 'search'])->name('search');
Route::get('/favorite', [ViewController::class, 'favorite'])->name('favorite');
Route::post('/search_paper', [ViewController::class, 'searchPaper']);
Route::post('/bookmark', [BookmarkController::class, 'bookmark']);
Route::post('/delete', [BookmarkController::class, 'delete'])->name('delete');
Route::get('/search_bookmark', [BookmarkController::class, 'search']);
Route::post('/update_memo', [BookmarkController::class, 'updateMemo']);
    
