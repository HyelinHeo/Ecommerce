<?php
/**
 * File name: api.php
 * Last modified: 2020.04.30 at 08:21:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::prefix('driver')->group(function () {
    Route::post('login', 'API\Driver\UserAPIController@login');
    Route::post('register', 'API\Driver\UserAPIController@register');
    Route::post('send_reset_link_email', 'API\UserAPIController@sendResetLinkEmail');
    Route::get('user', 'API\Driver\UserAPIController@user');
    Route::get('logout', 'API\Driver\UserAPIController@logout');
    Route::get('settings', 'API\Driver\UserAPIController@settings');
});

Route::prefix('manager')->group(function () {
    Route::post('login', 'API\Manager\UserAPIController@login');
    Route::post('register', 'API\Manager\UserAPIController@register');
    Route::post('send_reset_link_email', 'API\UserAPIController@sendResetLinkEmail');
    Route::get('user', 'API\Manager\UserAPIController@user');
    Route::get('logout', 'API\Manager\UserAPIController@logout');
    Route::get('settings', 'API\Manager\UserAPIController@settings');
});
*/

//Route::get('user', 'API\UserAPIController@user');
//Route::resource('fields', 'API\FieldAPIController');
//Route::resource('markets', 'API\MarketAPIController');

Route::resource('faq_categories', 'API\FaqCategoryAPIController');
//Route::get('products/categories', 'API\ProductAPIController@categories');
//Route::resource('galleries', 'API\GalleryAPIController');
//Route::resource('product_reviews', 'API\ProductReviewAPIController');


//Route::resource('faqs', 'API\FaqAPIController');
//Route::resource('market_reviews', 'API\MarketReviewAPIController');
//Route::resource('currencies', 'API\CurrencyAPIController');

//Route::resource('option_groups', 'API\OptionGroupAPIController');

//Route::resource('options', 'API\OptionAPIController');
//Route::resource('sms', 'API\SmsAPIController');

// eidt by zenith

Route::post('login', 'API\UserAPIController@login');
Route::post('loginsns', 'API\UserAPIController@loginSns');
Route::post('checkemailbyphone', 'API\UserAPIController@getUserEmailByPhone');
Route::post('register', 'API\UserAPIController@register');
Route::post('send_reset_link_email', 'API\UserAPIController@sendResetLinkEmail');
Route::get('logout', 'API\UserAPIController@logout');
Route::get('settings', 'API\UserAPIController@settings');
Route::resource('systemsettings', 'API\SystemSettingsAPIController');
Route::resource('categories', 'API\CategoryAPIController');
Route::resource('websettings', 'API\WebSettingsAPIController');
Route::resource('companysettings', 'API\CompanySettingsAPIController');

// edit by zenith
Route::resource('datasync/etomars', 'API\EtomarsAPIController');
Route::resource('datasync/homepick', 'API\HomepickAPIController');

Route::post('userfeedback', 'API\UserFeedbackAPIController@register');

// added by zenith at 20210612 : PG사에서 호출하는 api로, api key를 넣지 않도록 한다.
Route::post('paymentresult', 'API\PaymentAPIController@paymentresult');
Route::get('paymentresult', 'API\PaymentAPIController@paymentresult');
Route::post('wpayresult', 'API\PaymentAPIController@wpayresult');
Route::get('wpayresult', 'API\PaymentAPIController@wpayresult');

Route::middleware('auth:api')->group(function () {
    /*
    Route::group(['middleware' => ['role:driver']], function () {
        Route::prefix('driver')->group(function () {
            Route::resource('orders', 'API\OrderAPIController');
            Route::resource('notifications', 'API\NotificationAPIController');
            Route::post('users/{id}', 'API\UserAPIController@update');
            Route::resource('faq_categories', 'API\FaqCategoryAPIController');
            Route::resource('faqs', 'API\FaqAPIController');
        });
    });
    Route::group(['middleware' => ['role:manager']], function () {
        Route::prefix('manager')->group(function () {
            Route::post('users/{id}', 'API\UserAPIController@update');
            Route::get('users/drivers_of_market/{id}', 'API\Manager\UserAPIController@driversOfMarket');
            Route::get('dashboard/{id}', 'API\DashboardAPIController@manager');
            Route::resource('markets', 'API\Manager\MarketAPIController');
        });
    });
    */
    // added by zenith at 20210714 
//    Route::resource('countrynews', 'API\CountryNewsAPIController');
    Route::get('newsSummary', 'API\CountryNewsAPIController@newssummary');
    Route::get('newsList', 'API\CountryNewsAPIController@newslist');

    Route::resource('products', 'API\ProductAPIController');
    Route::resource('pickuppricesettings', 'API\PickupPriceSettingsAPIController');
    //Route::post('pickuppricesettings', 'API\PickupPriceSettingsAPIController@getPriceSetting');
    //Route::get('pickuppricesettings', 'API\PickupPriceSettingsAPIController@getPriceSetting');
    Route::resource('pickupdatesettings', 'API\PickupDateSettingsAPIController');
    Route::resource('notice', 'API\NoticeAPIController'); 
    Route::resource('nationInfo', 'API\NationInfoAPIController'); 
    Route::resource('nationShipping', 'API\NationShippingAPIController'); 
    Route::resource('shippingprice', 'API\ShippingPriceAPIController');
    Route::get('zipcode', 'API\ZipcodeAddressAPIController@searchAddress');
    Route::get('pickupsupportarealocal', 'API\PickupAPIController@pickupSupportAreaLocal');
    Route::get('pickupsupportarea', 'API\PickupAPIController@pickupSupportArea');
    //Route::get('pickupvisitabledate', 'API\PickupAPIController@pickupVisitableDate'); 폼픽의 api를 더이상 사용하지 않도록 한다.
    Route::get('tracking', 'API\TrackingAPIController@trackingShipping');
    Route::get('paymentreceipt', 'API\PaymentAPIController@paymentreceipt');

    // added by zenith at 20210612
    Route::post('users/{id}', 'API\UserAPIController@update');
    Route::resource('order_statuses', 'API\OrderStatusAPIController');

    Route::get('payments/byMonth', 'API\PaymentAPIController@byMonth')->name('payments.byMonth');
    Route::resource('payments', 'API\PaymentAPIController');
    Route::get('paymentSystemInfo', 'API\PaymentAPIController@paymentSystemInfo');
    //Route::get('wpaySystemInfo', 'API\PaymentAPIController@wpaySystemInfo');

    Route::resource('paymentmethod', 'API\PaymentMethodAPIController');
    Route::resource('pickupPayouts', 'API\PickupPayoutAPIController');

    Route::get('events/count', 'API\EventAPIController@count');
    Route::resource('events', 'API\EventAPIController');
    Route::resource('eventsUsed', 'API\EventUsedAPIController');

    //Route::get('favorites/exist', 'API\FavoriteAPIController@exist');
    //Route::resource('favorites', 'API\FavoriteAPIController');

    Route::resource('orders', 'API\OrderAPIController');
    Route::post('orders/{id}', 'API\OrderAPIController@update');
    Route::get('orders/cancel/{id}', 'API\OrderAPIController@cancel');
    Route::post('orders/cancel/{id}', 'API\OrderAPIController@cancel');
    Route::post('orders/update/{id}', 'API\OrderAPIController@updateByUser');
    Route::resource('orderalert', 'API\OrderAlertAPIController');

    //Route::resource('product_orders', 'API\ProductOrderAPIController');
    Route::get('notifications/count', 'API\NotificationAPIController@count');
    Route::post('notifications/updateAll', 'API\NotificationAPIController@updateAll');
    Route::resource('notifications', 'API\NotificationAPIController');

    Route::post('checkDupUserEmail', 'API\UserAPIController@checkDupUserEmail');

    //Route::get('carts/count', 'API\CartAPIController@count')->name('carts.count');
    //Route::resource('carts', 'API\CartAPIController');
    //Route::resource('delivery_addresses', 'API\DeliveryAddressAPIController');
    //Route::resource('drivers', 'API\DriverAPIController');
    //Route::resource('earnings', 'API\EarningAPIController');
    //Route::resource('driversPayouts', 'API\DriversPayoutAPIController');

    //Route::resource('marketsPayouts', 'API\MarketsPayoutAPIController');
    //Route::resource('coupons', 'API\CouponAPIController')->except(['show']);

    // zenith add
});