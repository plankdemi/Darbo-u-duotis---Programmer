<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TruckOperations;


Route::get('/trucks', [TruckOperations::class, 'getTrucks'])->name('getTrucks');
Route::get('/truck/{unitNumber}', [TruckOperations::class, 'getTruckSubs']);
Route::post('/cr&u', [TruckOperations::class, 'modifyTruck'])->name('cr&u');
Route::post('/delete', [TruckOperations::class, 'deleteTruck'])->name('delete');
Route::post('/createSub', [TruckOperations::class, 'createTruckSubs'])->name('createSub');