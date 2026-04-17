<?php

Route::prefix('v1')->namespace('v1')->as('v1.')->group(function () {
    Route::post('companies', [
        \App\Http\Controllers\Api\V1\StoreCompanyController::class, '__invoke'
    ])->name('companies.store');
    Route::get('companies/{edrpou}/versions', [
        \App\Http\Controllers\Api\V1\IndexCompanyVersionsController::class, '__invoke'
    ])->name('companies.versions.index');
});
