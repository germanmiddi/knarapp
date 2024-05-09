<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Manager\DashboardController;
use App\Http\Controllers\Manager\Client\ClientController;
use App\Http\Controllers\Manager\Service\ServiceController;

use App\Http\Controllers\Manager\Order\OrderController;
use App\Http\Controllers\Manager\Request\RequestController;
use App\Http\Controllers\Manager\Servicepricelist\ServicepricelistController;
use App\Http\Controllers\Manager\Setting\SettingController;
use App\Http\Controllers\Manager\Location\LocationController;
use App\Http\Controllers\Manager\Driver\DriverController;
use App\Http\Controllers\Manager\Driver\DriverServicePriceController;
use App\Http\Controllers\Manager\Setting\SettingsUserController;
use App\Http\Controllers\Manager\RequestService\RequestServiceController;
use App\Http\Controllers\Manager\RequestServicesItem\RequestServicesItemController;

use App\Http\Controllers\Web\Reservas\ReservasController;

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

Route::get('/request/{requests}/edit', [RequestController::class, 'edit'])
    ->name('request.edit')
    ->middleware('auth');

Route::get('/request/create', [RequestController::class, 'create'])
    ->name('request.create')
    ->middleware('auth');

Route::post('/request/store ', [RequestController::class, 'store'])
    ->name('request.store')
    ->middleware('auth');

Route::get('/requestservice/{requestService}/cancel', [RequestServiceController::class, 'cancel'])
    ->name('requestservice.cancel')
    ->middleware('auth');

Route::post('/requestservice/confirmService', [RequestServiceController::class, 'confirm'])
    ->name('requestservice.confirm')
    ->middleware('auth');

        
// Request Services  
  
Route::get('/services', [ServiceController::class, 'index'])
    ->name('services')
    ->middleware('auth');

Route::get('/services/list', [ServiceController::class, 'list'])
    ->name('services.list')
    ->middleware('auth');

Route::get('/service/{service}/edit', [ServiceController::class, 'edit'])
    ->name('service.edit')
    ->middleware('auth');

Route::get('/service/{service}', [ServiceController::class, 'confirmService'])
    ->name('service.confirm')
    ->middleware('auth');

Route::post('/requestServicesItem/store', [RequestServicesItemController::class, 'store'])
    ->name('requestServicesItem.store')
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

Route::post('/client/update', [ClientController::class, 'update'])
    ->name('client.update')
    ->middleware('auth');    

Route::post('/client/destroy', [ClientController::class, 'destroy'])
    ->name('client.destroy')
    ->middleware('auth');    

    
// Drivers

Route::get('/drivers', [DriverController::class, 'index'])
    ->name('drivers')
    ->middleware('auth');

Route::get('/drivers/list', [DriverController::class, 'list'])
    ->name('drivers.list')
    ->middleware('auth');

Route::get('/driver/create', [DriverController::class, 'create'])
    ->name('driver.create')
    ->middleware('auth');

Route::post('/driver/store', [DriverController::class, 'store'])
    ->name('driver.store')
    ->middleware('auth');

Route::get('/driver/{driver}/edit', [DriverController::class, 'edit'])
    ->name('driver.edit')
    ->middleware('auth');

Route::post('/driver/update', [DriverController::class, 'update'])
    ->name('driver.update')
    ->middleware('auth');    

Route::post('/drivers_service_price/store', [DriverServicePriceController::class, 'store'])
    ->name('drivers_service_price.store')
    ->middleware('auth');

Route::post('/drivers_service_price/toggleActive', [DriverServicePriceController::class, 'toggleActive'])
    ->name('drivers_service_price.toggleActive')
    ->middleware('auth');


// Service Price List
// Filtra los servicios para el formulario de alta de solicitudes
Route::get('/services/filter', [ServicepricelistController::class, 'filter'])
    ->name('services.filter')
    ->middleware('auth');

Route::get('/services/get_services_types_by_client', [ServicepricelistController::class, 'get_services_types_by_client'])
    ->name('services.get_services_types_by_client')
    ->middleware('auth');    
    

Route::post('/clients_service_list/toggleActive', [ServicepricelistController::class, 'toggleActive'])
    ->name('clients_service_list.toggleActive')
    ->middleware('auth');    

Route::post('/clients_service_list/store', [ServicepricelistController::class, 'store'])
    ->name('clients_service_list.store')
    ->middleware('auth');    

    

// Setting

Route::get('/setting', [SettingController::class, 'index'])
     ->name('setting')
     ->middleware('auth');

Route::get('/settings/services/list', [SettingController::class, 'services_list'])
    ->name('settings.services.list')
    ->middleware('auth');

Route::post('/settings/services/store', [SettingController::class, 'services_store'])
    ->name('settings.services.store')
    ->middleware('auth');

Route::post('/settings/services/update', [SettingController::class, 'services_update'])
    ->name('settings.services.update')
    ->middleware('auth');
      

Route::get('/service_type/list', [SettingController::class, 'service_type_list'])
    ->name('services_type.list')
    ->middleware('auth');

Route::get('/service_type/list_all', [SettingController::class, 'service_type_list_all'])
    ->name('services_type.list_all')
    ->middleware('auth');


Route::get('/services_price_list_base/list', [SettingController::class, 'services_price_list_base_list'])
    ->name('services_price_list_base.list')
    ->middleware('auth');

Route::post('/services_price_list_base/store', [SettingController::class, 'services_price_list_base_store'])
    ->name('services_price_list_base.store')
    ->middleware('auth');


Route::post('/services_price_list_base/update', [SettingController::class, 'services_price_list_base_update'])
    ->name('services_price_list_base.update')
    ->middleware('auth');    

Route::post('/services_price_list_base/delete', [SettingController::class, 'services_price_list_base_delete'])
    ->name('services_price_list_base.delete')
    ->middleware('auth');    

Route::get('/settings/users/list', [SettingsUserController::class, 'list'])->name('settings.users.list')
    ->middleware('auth');
    
//Location

Route::get('/location/list', [LocationController::class, 'list'])
    ->name('location.list')
    ->middleware('auth');


// Web

Route::get('/reservas', [ReservasController::class, 'index'])
    ->name('reservas')
    ->middleware('auth');

Route::post('/reservas/store', [ReservasController::class, 'store'])
    ->name('reservas.store')
    ->middleware('auth');