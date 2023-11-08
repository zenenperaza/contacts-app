<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;


Route::get('/', fn () => auth()->check() ? redirect('/home') : view('welcome'));


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/contacts/create', [ContactController::class, 'create'] )->name('contacts.create');
Route::get('/contacts', [HomeController::class, 'index'])->name('contacts');
Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'] )->name('contacts.edit');
Route::put('/contacts/{contact}/', [ContactController::class, 'update'] )->name('contacts.update');
Route::get('/contacts/{contact}/', [ContactController::class, 'show'] )->name('contacts.show');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::delete('/contacts/{contact}/', [ContactController::class, 'destroy'] )->name('contacts.destroy');
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
