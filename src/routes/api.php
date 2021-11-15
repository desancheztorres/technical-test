<?php

use App\Http\Controllers\Doctors\{CreateDoctorController, GetAllDoctorsController, GetDoctorController};
use App\Http\Controllers\DoctorSlots\{GetAllDoctorSlotsController};
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'doctors'], function () {
    Route::get('/', GetAllDoctorsController::class);
    Route::get('/{id}', GetDoctorController::class);
    Route::post('/', CreateDoctorController::class);
});

Route::group(['prefix' => 'slots'], function () {
    Route::get('/', GetAllDoctorSlotsController::class);
});
