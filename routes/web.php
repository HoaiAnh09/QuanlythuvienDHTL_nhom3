<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\BorrowReturnController;
use App\Http\Controllers\ProfileController;
use App\Models\BorrowReturn;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookRequestController;
use App\Http\Controllers\StaffController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/staff/dashboard', [StaffController::class, 'index'])->name('staff.dashboard');
    Route::get('/staff/edit/{id}', [StaffController::class, 'edit'])->name('staff.edit');
    Route::put('/staff/update/{id}', [StaffController::class, 'update'])->name('staff.update');
    Route::delete('/staff/delete/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/dashboard', [BookController::class, 'index'])->middleware(['auth', 'verified'])->name('books.index');  
Route::get('/books', [BookController::class, 'show'])->middleware(['auth', 'verified'])->name('books.show');
Route::post('/borrow', [BorrowController::class, 'borrowBook'])->middleware(['auth', 'verified'])->name('books.borrow');
Route::get('/borrow', [BorrowReturnController::class, 'showBorrowForm'])->middleware(['auth', 'verified'])->name('books.showFormBorrow');
Route::get('/check-user', [ProfileController::class, 'search'])->middleware(['auth', 'verified'])->name('user.check');
Route::get('/borrow-returns', [BorrowReturnController::class, 'index'])->middleware(['auth', 'verified'])->name('borrow_returns.index');
Route::get('/borrow-returns/{id}', action: [BorrowReturnController::class, 'show'])->name('borrow_returns.show');
Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::post('/books/{id}', [BookController::class, 'update'])->name('books.update');
Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');

Route::get('/return-book', [BorrowReturnController::class, 'returnForm'])->name('return.form');
Route::post('/return-book', [BorrowReturnController::class, 'returnBook'])->name('return.book');require __DIR__.'/auth.php';

Route::get('/book-requests/create', [BookRequestController::class, 'create'])->name('book_requests.create');
    Route::post('/book-requests', [BookRequestController::class, 'index'])->name('book_requests.store');

    Route::get('/book-requests', [BookRequestController::class, 'index'])->name('book_requests.index');
    Route::patch('/book-requests/{id}/approve', [BookRequestController::class, 'approve'])->name('book_requests.approve'); 