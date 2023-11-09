<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', fn () => auth()->check() ? redirect('/home') : view('welcome'));

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('contacts', ContactController::class);
