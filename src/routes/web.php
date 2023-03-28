<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Manager\DashboardController;
use App\Http\Controllers\Manager\Client\ClientController;
use App\Http\Controllers\Manager\Order\OrderController;

// Dashboard

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

Route::get('/order', [OrderController::class, 'index'])
    ->name('order')
    ->middleware('auth');

Route::get('/client', [ClientController::class, 'index'])
    ->name('client')
    ->middleware('auth');

Route::get('/client/create', [ClientController::class, 'create'])
    ->name('client.create')
    ->middleware('auth');

Route::get('/client/store', [ClientController::class, 'store'])
    ->name('client.store')
    ->middleware('auth');

Route::get('/clients/list', [ClientController::class, 'list'])
    ->name('clients.list')
    ->middleware('auth');


// -- 
