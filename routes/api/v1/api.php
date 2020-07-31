<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth is available using Passport, but not required in this case.
Route::post('auth', 'api\v1\AuthController@auth');

// Currency -> Codes
Route::get('currency/codes', 'api\v1\CurrencyController@codes');

// Currency -> Convert
Route::post('currency/convert', 'api\v1\CurrencyController@convert');
