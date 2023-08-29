<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ChatBotController;

// List of all companies
//Route::get('/', [CompanyController::class, 'index']);

// Display News Component


// List of all companies & Display News Component
Route::get('/', [CompanyController::class, 'index']);

// Sends contact form data to contact table in DB
Route::post('/', [ContactController::class, 'store'])->name('contact.us.store');

// Show edit form for Users
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->middleware('auth')->name('user.edit');

// Update User Profile information
Route::put('/users/{user}', [UserController::class, 'update'])->middleware('auth')->name('user.update');

Route::post('/companies/add/{ticker}', [CompanyController::class, 'store']);

// display all users in manage user view
Route::get('/manage-users', [UserController::class, 'manageUsers'])->name('manage.users');

Route::delete('/delete-user/{user}', [UserController::class, 'deleteUser'])->name('delete.user');

// Display one of the companies
Route::get('/companies/{ticker}', [CompanyController::class, 'show'])->middleware('auth');

// Present the registration form
Route::get('/register', [UserController::class, 'create']);

// User is registered
Route::post('/users', [UserController::class, 'store']);

// Logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Present the login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// User logged in
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Display user data
Route::get('/users/{id}', [UserController::class, 'show'])->middleware('auth');

// Route::get('/contact', [ContactController::class, 'index']);

Route::get('/users/{user}/dashboard', [UserController::class, 'dashboard'])->middleware('auth');



Route::get('/users/{user}/dashboard/{company}', [PortfolioController::class, 'destroy'])->middleware('auth');


// AI chatbox - sendChat
Route::post('send', [ChatBotController::class, 'sendChat']);