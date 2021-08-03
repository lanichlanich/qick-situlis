<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Asset Category
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Location
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Status
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Asset
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::resource('assets', 'AssetController');

    // Assets History
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Expense Category
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Income Category
    Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
    Route::resource('income-categories', 'IncomeCategoryController');

    // Expense
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::resource('expenses', 'ExpenseController');

    // Income
    Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
    Route::resource('incomes', 'IncomeController');

    // Expense Report
    Route::delete('expense-reports/destroy', 'ExpenseReportController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('expense-reports', 'ExpenseReportController');

    // Surat Keluar
    Route::delete('surat-keluars/destroy', 'SuratKeluarController@massDestroy')->name('surat-keluars.massDestroy');
    Route::post('surat-keluars/media', 'SuratKeluarController@storeMedia')->name('surat-keluars.storeMedia');
    Route::post('surat-keluars/ckmedia', 'SuratKeluarController@storeCKEditorImages')->name('surat-keluars.storeCKEditorImages');
    Route::resource('surat-keluars', 'SuratKeluarController');

    // Surat Masuk
    Route::delete('surat-masuks/destroy', 'SuratMasukController@massDestroy')->name('surat-masuks.massDestroy');
    Route::post('surat-masuks/media', 'SuratMasukController@storeMedia')->name('surat-masuks.storeMedia');
    Route::post('surat-masuks/ckmedia', 'SuratMasukController@storeCKEditorImages')->name('surat-masuks.storeCKEditorImages');
    Route::resource('surat-masuks', 'SuratMasukController');

    // Sk Kgb Pns
    Route::delete('sk-kgb-pns/destroy', 'SkKgbPnsController@massDestroy')->name('sk-kgb-pns.massDestroy');
    Route::post('sk-kgb-pns/media', 'SkKgbPnsController@storeMedia')->name('sk-kgb-pns.storeMedia');
    Route::post('sk-kgb-pns/ckmedia', 'SkKgbPnsController@storeCKEditorImages')->name('sk-kgb-pns.storeCKEditorImages');
    Route::resource('sk-kgb-pns', 'SkKgbPnsController');

    // Sk Cpns
    Route::delete('sk-cpns/destroy', 'SkCpnsController@massDestroy')->name('sk-cpns.massDestroy');
    Route::post('sk-cpns/media', 'SkCpnsController@storeMedia')->name('sk-cpns.storeMedia');
    Route::post('sk-cpns/ckmedia', 'SkCpnsController@storeCKEditorImages')->name('sk-cpns.storeCKEditorImages');
    Route::resource('sk-cpns', 'SkCpnsController');

    // Sk Kepangkatan Pns
    Route::delete('sk-kepangkatan-pns/destroy', 'SkKepangkatanPnsController@massDestroy')->name('sk-kepangkatan-pns.massDestroy');
    Route::post('sk-kepangkatan-pns/media', 'SkKepangkatanPnsController@storeMedia')->name('sk-kepangkatan-pns.storeMedia');
    Route::post('sk-kepangkatan-pns/ckmedia', 'SkKepangkatanPnsController@storeCKEditorImages')->name('sk-kepangkatan-pns.storeCKEditorImages');
    Route::resource('sk-kepangkatan-pns', 'SkKepangkatanPnsController');

    // Sk Pengangkatan Honorer
    Route::delete('sk-pengangkatan-honorers/destroy', 'SkPengangkatanHonorerController@massDestroy')->name('sk-pengangkatan-honorers.massDestroy');
    Route::post('sk-pengangkatan-honorers/media', 'SkPengangkatanHonorerController@storeMedia')->name('sk-pengangkatan-honorers.storeMedia');
    Route::post('sk-pengangkatan-honorers/ckmedia', 'SkPengangkatanHonorerController@storeCKEditorImages')->name('sk-pengangkatan-honorers.storeCKEditorImages');
    Route::resource('sk-pengangkatan-honorers', 'SkPengangkatanHonorerController');

    // Ptk
    Route::delete('ptks/destroy', 'PtkController@massDestroy')->name('ptks.massDestroy');
    Route::resource('ptks', 'PtkController');

    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
