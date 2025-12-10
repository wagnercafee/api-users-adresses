<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserSearchController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);

Route::apiResource('addresses', AddressController::class);

Route::apiResource('profiles', ProfileController::class);

Route::post('/users/{user}/addresses', [UserAddressController::class, 'store']);

Route::put('/users/{user}/profile', [UserProfileController::class, 'update']);

Route::post('/users/search', [UserSearchController::class, 'search']);
