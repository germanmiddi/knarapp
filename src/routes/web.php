<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Manager\DashboardController;
use App\Http\Controllers\Manager\Client\ClientController;
use App\Http\Controllers\Manager\Order\OrderController;
use App\Http\Controllers\Manager\Request\RequestController;
use App\Http\Controllers\Manager\Servicepricelist\ServicepricelistController;
use App\Http\Controllers\Manager\Setting\SettingController;
use App\Http\Controllers\Manager\Location\LocationController;

// Dashboard

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// Dashboard

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// Request
Route::get('/request', [RequestController::class, 'index'])
    ->name('request')
    ->middleware('auth');

Route::get('/request/list', [RequestController::class, 'list'])
    ->name('request.list')
    ->middleware('auth');

Route::get('/request/create', [RequestController::class, 'create'])
    ->name('request.create')
    ->middleware('auth');

Route::get('/request/store ', [RequestController::class, 'store'])
    ->name('request.store')
    ->middleware('auth');

// Order    
Route::get('/order', [OrderController::class, 'index'])
    ->name('order')
    ->middleware('auth');


// Client    
Route::get('/client', [ClientController::class, 'index'])
    ->name('client')
    ->middleware('auth');

Route::get('/client/create', [ClientController::class, 'create'])
    ->name('client.create')
    ->middleware('auth');

Route::post('/client/store', [ClientController::class, 'store'])
    ->name('client.store')
    ->middleware('auth');

Route::get('/clients/list', [ClientController::class, 'list'])
    ->name('clients.list')
    ->middleware('auth');

Route::get('client/{client}/edit', [ClientController::class, 'edit'])
    ->name('client.edit')
    ->middleware('auth');


// Service Price List

Route::get('/services/filter', [ServicepricelistController::class, 'filter'])
    ->name('services.filter')
    ->middleware('auth');

// Setting

Route::get('/setting', [SettingController::class, 'index'])
     ->name('setting')
     ->middleware('auth');

//Location

Route::get('/location/list', [LocationController::class, 'list'])
    ->name('location.list')
    ->middleware('auth');