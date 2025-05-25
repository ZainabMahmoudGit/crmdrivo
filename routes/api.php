<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\TripController;

Route::apiResource('clients', ClientController::class);

Route::apiResource('sales', SaleController::class);

Route::apiResource('contractors', ContractorController::class);

Route::apiResource('trips', TripController::class);


//  GET|HEAD        api/clients ...... clients. ›index › ClientController@index  
//   POST            api/clients ...... clients.store ClientController@store  
//   GET|HEAD        api/clients/{client} ...... clients.show › ClientController@show  
//   PUT|PATCH       api/clients/{client} ....... clients.update › ClientController@update  
//   DELETE          api/clients/{client} ........ clients.destroy › ClientController@destroy  
//   GET|HEAD        api/contractors ........ contractors.index › ContractorController@index  
//   POST            api/contractors ................................................................... contractors.store › ContractorController@store  
//   GET|HEAD        api/contractors/{contractor} ........................................................ contractors.show › ContractorController@show  
//   PUT|PATCH       api/contractors/{contractor} .................................................... contractors.update › ContractorController@update  
//   DELETE          api/contractors/{contractor} .................................................. contractors.destroy › ContractorController@destroy  
//   GET|HEAD        api/sales ..................................................................................... sales.index › SaleController@index  
//   POST            api/sales ..................................................................................... sales.store › SaleController@store  
//   GET|HEAD        api/sales/{sale} ................................................................................ sales.show › SaleController@show  
//   PUT|PATCH       api/sales/{sale} ............................................................................ sales.update › SaleController@update
//   DELETE          api/sales/{sale} .......................................................................... sales.destroy › SaleController@destroy  
//   GET|HEAD        api/trips ..................................................................................... trips.index › TripController@index  
//   POST            api/trips ..................................................................................... trips.store › TripController@store  
//   GET|HEAD        api/trips/{trip} ................................................................................ trips.show › TripController@show  
//   PUT|PATCH       api/trips/{trip} ............................................................................ trips.update › TripController@update  
//   DELETE          api/trips/{trip} .......................................................................... trips.destroy › TripController@destroy  
