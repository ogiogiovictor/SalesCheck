<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Company\CompanyController;


/************************************* IBEDC ALTERNATE PAYMENT SYSTEM **************************************************/
Route::group(['prefix' => 'V1_AWMXS4dnsY_UCompanyUservice', 'name' => 'Api\v1'], function () {

    Route::apiResource('company', CompanyController::class)->except('edit');

});

