<?php
/**
 * File name: web.php
 * Last modified: 2020.06.07 at 07:02:57
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login/{service}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{service}/callback', 'Auth\LoginController@handleProviderCallback');
Auth::routes();

Route::get('payments/failed', 'PayPalController@index')->name('payments.failed');
Route::get('payments/razorpay/checkout', 'RazorPayController@checkout');
Route::post('payments/razorpay/pay-success/{userId}/{deliveryAddressId?}/{couponCode?}', 'RazorPayController@paySuccess');
Route::get('payments/razorpay', 'RazorPayController@index');

Route::get('payments/paypal/express-checkout', 'PayPalController@getExpressCheckout')->name('paypal.express-checkout');
Route::get('payments/paypal/express-checkout-success', 'PayPalController@getExpressCheckoutSuccess');
Route::get('payments/paypal', 'PayPalController@index')->name('paypal.index');

Route::get('firebase/sw-js','AppSettingController@initFirebase');


Route::get('storage/app/public/{id}/{conversion}/{filename?}', 'UploadController@storage');
Route::middleware('auth')->group(function () {
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::post('uploads/store', 'UploadController@store')->name('medias.create');
    Route::get('users/profile', 'UserController@profile')->name('users.profile');
    Route::post('users/remove-media', 'UserController@removeMedia');
    Route::resource('users', 'UserController');
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::group(['middleware' => ['permission:medias']], function () {
        Route::get('uploads/all/{collection?}', 'UploadController@all');
        Route::get('uploads/collectionsNames', 'UploadController@collectionsNames');
        Route::post('uploads/clear', 'UploadController@clear')->name('medias.delete');
        Route::get('medias', 'UploadController@index')->name('medias');
        Route::get('uploads/clear-all', 'UploadController@clearAll');
    });

    Route::group(['middleware' => ['permission:permissions.index']], function () {
        Route::get('permissions/role-has-permission', 'PermissionController@roleHasPermission');
        Route::get('permissions/refresh-permissions', 'PermissionController@refreshPermissions');
    });
    Route::group(['middleware' => ['permission:permissions.index']], function () {
        Route::post('permissions/give-permission-to-role', 'PermissionController@givePermissionToRole');
        Route::post('permissions/revoke-permission-to-role', 'PermissionController@revokePermissionToRole');
    });

    Route::group(['middleware' => ['permission:app-settings']], function () {
        Route::prefix('settings')->group(function () {
            Route::resource('permissions', 'PermissionController');
            Route::resource('roles', 'RoleController');
            Route::resource('customFields', 'CustomFieldController');
            Route::resource('currencies', 'CurrencyController')->except([
                'show'
            ]);
            Route::get('users/login-as-user/{id}', 'UserController@loginAsUser')->name('users.login-as-user');
            Route::patch('update', 'AppSettingController@update');
            Route::patch('translate', 'AppSettingController@translate');
            Route::get('sync-translation', 'AppSettingController@syncTranslation');
            Route::get('clear-cache', 'AppSettingController@clearCache');
            Route::get('check-update', 'AppSettingController@checkForUpdates');
            // disable special character and number in route params
            Route::get('/{type?}/{tab?}', 'AppSettingController@index')
                ->where('type', '[A-Za-z]*')->where('tab', '[A-Za-z]*')->name('app-settings');
        });
    });

    Route::post('fields/remove-media','FieldController@removeMedia');
    Route::resource('fields', 'FieldController')->except([
        'show'
    ]);

    Route::post('markets/remove-media', 'MarketController@removeMedia');
    Route::get('requestedMarkets', 'MarketController@requestedMarkets')->name('requestedMarkets.index'); //adeed
    Route::resource('markets', 'MarketController')->except([
        'show'
    ]);

    Route::post('categories/remove-media', 'CategoryController@removeMedia'); 
    Route::resource('categories', 'CategoryController');
    //add Event_20210823_hyerin
    Route::resource('events', 'EventController');
    //add Notice_20210902_hyerin
    Route::resource('notice', 'NoticeController');
    //add CountryNews_20210903_hyerin
    Route::resource('countryNews', 'CountryNewsController');

    Route::resource('faqCategories', 'FaqCategoryController');

    Route::resource('orderStatuses', 'OrderStatusController')->except([
        'create', 'store', 'destroy'
    ]);;

    Route::post('products/remove-media', 'ProductController@removeMedia');
    Route::resource('products', 'ProductController')->except([
        'show'
    ]);

    Route::post('galleries/remove-media', 'GalleryController@removeMedia');
    Route::resource('galleries', 'GalleryController')->except([
        'show'
    ]);

    Route::resource('productReviews', 'ProductReviewController')->except([
        'show'
    ]);

    Route::post('options/remove-media', 'OptionController@removeMedia');
    

    Route::resource('payments', 'PaymentController')->except([
        'create', 'store','edit', 'destroy'
    ]);;

    Route::resource('faqs', 'FaqController');
    Route::resource('marketReviews', 'MarketReviewController')->except([
        'show'
    ]);

    Route::resource('favorites', 'FavoriteController')->except([
        'show'
    ]);

    Route::resource('orders', 'OrderController');

    Route::GET('datasync/etomars', 'EtomarsController@updateFromEtomarsStatusData');
    Route::resource('etomars', 'EtomarsController');

    Route::resource('notifications', 'NotificationController')->except([
        'create'
    ]);

    Route::resource('carts', 'CartController')->except([
        'show','store','create'
    ]);
    
    Route::resource('deliveryAddresses', 'DeliveryAddressController')->except([
        'create'
    ]);

    Route::resource('drivers', 'DriverController')->except([
        'show'
    ]);

    Route::resource('earnings', 'EarningController')->except([
        'show','edit','update'
    ]);

    Route::resource('driversPayouts', 'DriversPayoutController')->except([
        'show','edit','update'
    ]);
    //add pickupPayout_20210624_hyerin
    Route::resource('pickupPayouts', 'PickupPayoutController')->except([
        'update'
    ]);
    //add photoTranslations done_20211001_hyerin
    Route::get('photoTranslationsUS/done', [ 'as' => 'photoTranslationsUS.done', 'uses' => 'PhotoTranslationControllerUS@indexDone']);
    Route::get('photoTranslationsCN/done', [ 'as' => 'photoTranslationsCN.done', 'uses' => 'PhotoTranslationControllerCN@indexDone']);
    Route::get('photoTranslationsID/done', [ 'as' => 'photoTranslationsID.done', 'uses' => 'PhotoTranslationControllerID@indexDone']);
    Route::get('photoTranslationsMY/done', [ 'as' => 'photoTranslationsMY.done', 'uses' => 'PhotoTranslationControllerMY@indexDone']);
    Route::get('photoTranslationsTH/done', [ 'as' => 'photoTranslationsTH.done', 'uses' => 'PhotoTranslationControllerTH@indexDone']);
    Route::get('photoTranslationsVN/done', [ 'as' => 'photoTranslationsVN.done', 'uses' => 'PhotoTranslationControllerVN@indexDone']);
    Route::get('photoTranslationsTW/done', [ 'as' => 'photoTranslationsTW.done', 'uses' => 'PhotoTranslationControllerTW@indexDone']);
    Route::get('photoTranslationsHK/done', [ 'as' => 'photoTranslationsHK.done', 'uses' => 'PhotoTranslationControllerHK@indexDone']);
    Route::get('photoTranslationsJP/done', [ 'as' => 'photoTranslationsJP.done', 'uses' => 'PhotoTranslationControllerJP@indexDone']);
    //add photoTranslations_20210811_hyerin
    Route::resource('photoTranslationsUS', 'PhotoTranslationControllerUS')->except([
        'create','store'
    ]);
    //add photoTranslations_20210811_hyerin
    Route::resource('photoTranslationsCN', 'PhotoTranslationControllerCN')->except([
        'create','store'
    ]);
    //add photoTranslations_20210811_hyerin
    Route::resource('photoTranslationsID', 'PhotoTranslationControllerID')->except([
        'create','store'
    ]);
    //add photoTranslations_20210811_hyerin
    Route::resource('photoTranslationsMY', 'PhotoTranslationControllerMY')->except([
        'create','store'
    ]);
    //add photoTranslations_20210811_hyerin
    Route::resource('photoTranslationsTH', 'PhotoTranslationControllerTH')->except([
        'create','store'
    ]);
    //add photoTranslations_20210811_hyerin
    Route::resource('photoTranslationsVN', 'PhotoTranslationControllerVN')->except([
        'create','store'
    ]);
    //add photoTranslations_20210811_hyerin
    Route::resource('photoTranslationsTW', 'PhotoTranslationControllerTW')->except([
        'create','store'
    ]);
    //add photoTranslations_20210811_hyerin
    Route::resource('photoTranslationsHK', 'PhotoTranslationControllerHK')->except([
        'create','store'
    ]);
    //add photoTranslations_20210811_hyerin
    Route::resource('photoTranslationsJP', 'PhotoTranslationControllerJP')->except([
        'create','store'
    ]);
    //add watchdogOrders_20210804_hyerin
    Route::resource('watchdogOrders', 'WatchdogOrderController')->except([
        'create','store'
    ]);
    //add watchdogPayments_20210805_hyerin
    Route::resource('watchdogPayments', 'WatchdogPaymentController')->except([
        'create','store'
    ]);
    //add watchdogPhotos_20210809_hyerin
    Route::resource('watchdogPhotos', 'WatchdogPhotoController')->except([
        'create','store'
    ]);
    //add watchdogUserFeedback_20210809_hyerin

    //add user feedback by type _ 20211019_hyerin
    Route::get('watchdogUserFeedback/error', [ 'as' => 'watchdogUserFeedback.error', 'uses' => 'WatchdogUserFeedbackController@indexError']);
    Route::get('watchdogUserFeedback/opinion', [ 'as' => 'watchdogUserFeedback.opinion', 'uses' => 'WatchdogUserFeedbackController@indexOpinion']);
    Route::get('watchdogUserFeedback/proposal', [ 'as' => 'watchdogUserFeedback.proposal', 'uses' => 'WatchdogUserFeedbackController@indexProposal']);
    Route::get('watchdogUserFeedback/translation', [ 'as' => 'watchdogUserFeedback.translation', 'uses' => 'WatchdogUserFeedbackController@indexTranslation']);
    Route::get('watchdogUserFeedback/withdrawal', [ 'as' => 'watchdogUserFeedback.withdrawal', 'uses' => 'WatchdogUserFeedbackController@indexWithdrawal']);
    Route::get('watchdogUserFeedback/duplicateReport', [ 'as' => 'watchdogUserFeedback.duplicateReport', 'uses' => 'WatchdogUserFeedbackController@indexDuplicateReport']);
    Route::get('watchdogUserFeedback/others', [ 'as' => 'watchdogUserFeedback.others', 'uses' => 'WatchdogUserFeedbackController@indexOthers']);
    Route::get('watchdogUserFeedback/done/{id}', [ 'as' => 'watchdogUserFeedback.done', 'uses' => 'WatchdogUserFeedbackController@done']);
    Route::resource('watchdogUserFeedback', 'WatchdogUserFeedbackController')->except([
        'create','store'
    ]);

    Route::resource('marketsPayouts', 'MarketsPayoutController')->except([
        'show','edit','update'
    ]);

    Route::resource('optionGroups', 'OptionGroupController')->except([
        'show'
    ]);

    Route::post('options/remove-media','OptionController@removeMedia');

    Route::resource('options', 'OptionController')->except([
        'show'
    ]);
    Route::resource('coupons', 'CouponController');

    //add notifications create _ 20211019_hyerin
    Route::get('notifications/create/users', [ 'as' => 'notifications.create.users', 'uses' => 'NotificationController@createuser']);
    Route::get('notifications/create/orders', [ 'as' => 'notifications.create.orders', 'uses' => 'NotificationController@createorder']);
    
});

