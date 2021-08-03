<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Asset Category
    Route::apiResource('asset-categories', 'AssetCategoryApiController');

    // Asset Location
    Route::apiResource('asset-locations', 'AssetLocationApiController');

    // Asset Status
    Route::apiResource('asset-statuses', 'AssetStatusApiController');

    // Asset
    Route::post('assets/media', 'AssetApiController@storeMedia')->name('assets.storeMedia');
    Route::apiResource('assets', 'AssetApiController');

    // Assets History
    Route::apiResource('assets-histories', 'AssetsHistoryApiController', ['except' => ['store', 'show', 'update', 'destroy']]);

    // Content Category
    Route::apiResource('content-categories', 'ContentCategoryApiController');

    // Content Tag
    Route::apiResource('content-tags', 'ContentTagApiController');

    // Content Page
    Route::post('content-pages/media', 'ContentPageApiController@storeMedia')->name('content-pages.storeMedia');
    Route::apiResource('content-pages', 'ContentPageApiController');

    // Expense Category
    Route::apiResource('expense-categories', 'ExpenseCategoryApiController');

    // Income Category
    Route::apiResource('income-categories', 'IncomeCategoryApiController');

    // Expense
    Route::apiResource('expenses', 'ExpenseApiController');

    // Income
    Route::apiResource('incomes', 'IncomeApiController');

    // Surat Keluar
    Route::post('surat-keluars/media', 'SuratKeluarApiController@storeMedia')->name('surat-keluars.storeMedia');
    Route::apiResource('surat-keluars', 'SuratKeluarApiController');

    // Surat Masuk
    Route::post('surat-masuks/media', 'SuratMasukApiController@storeMedia')->name('surat-masuks.storeMedia');
    Route::apiResource('surat-masuks', 'SuratMasukApiController');

    // Sk Kgb Pns
    Route::post('sk-kgb-pns/media', 'SkKgbPnsApiController@storeMedia')->name('sk-kgb-pns.storeMedia');
    Route::apiResource('sk-kgb-pns', 'SkKgbPnsApiController');

    // Sk Cpns
    Route::post('sk-cpns/media', 'SkCpnsApiController@storeMedia')->name('sk-cpns.storeMedia');
    Route::apiResource('sk-cpns', 'SkCpnsApiController');

    // Sk Kepangkatan Pns
    Route::post('sk-kepangkatan-pns/media', 'SkKepangkatanPnsApiController@storeMedia')->name('sk-kepangkatan-pns.storeMedia');
    Route::apiResource('sk-kepangkatan-pns', 'SkKepangkatanPnsApiController');

    // Sk Pengangkatan Honorer
    Route::post('sk-pengangkatan-honorers/media', 'SkPengangkatanHonorerApiController@storeMedia')->name('sk-pengangkatan-honorers.storeMedia');
    Route::apiResource('sk-pengangkatan-honorers', 'SkPengangkatanHonorerApiController');

    // Ptk
    Route::apiResource('ptks', 'PtkApiController');
});
