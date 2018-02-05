<?php

Route::get('/', 'SingleCheckAddressController@welcome');
Route::post('/single_check_address', 'SingleCheckAddressController@store');
Route::get('address/{property}', 'PropertyController@show');

Route::get('/signup', 'LeadsController@show');
Route::post('/store_lead', 'LeadsController@store');
Route::any('/logout', 'Auth\LoginController@logout');

Route::get('cleanup-account-type', function() {

    $types = \App\AccountType::all();
    $types->each(function ($type) {
        $type->delete();
    });

    \App\AccountType::create([
        'name' => 'REIT',
        'slug' => 'reit',
        'tip' => 'If you manage multiple properties as part of a REIT'
    ]);

    \App\AccountType::create([
        'name' => 'Property Manager',
        'slug' => 'property-manager',
        'tip' => 'If you manage, but don\'t own properties',
    ]);

    \App\AccountType::create([
        'name' => 'Property Owner',
        'slug' => 'property-owner',
        'tip' => 'If you own properties.',
    ]);

    \App\AccountType::create([
        'name' => 'Tenant',
        'slug' => 'tenant',
        'tip' => 'If you are a tenant',
    ]);
});

Route::get('/faq', 'PagesController@faq');

Route::get('/dashboard', 'PagesController@dashboard')->name('dashboard');
Route::get('/dashboard/map', 'PagesController@dashboardMap');
Route::get('/dashboard/list', 'PagesController@dashboardList');
Route::get('/profile', 'PagesController@profile');
Route::get('/property-map', 'PagesController@propertyMap')->name('property_map');
Route::get('/service-providers', 'PagesController@serviceProviders');

/* End of Routes */

Route::get('/home', 'HomeController@show')->middleware('verifyHasProperties');

Route::get('/blog', 'BlogController@index');
Route::get('/blog/{slug}', 'BlogController@show');

Route::get('property/dashboard', 'PropertyController@dashboard')->name('property_dashboard');
Route::get('property/batch', 'BatchPropertyUploadController@create');
Route::post('property/batch', 'BatchPropertyUploadController@store');
Route::get('property', 'PropertyController@create');
Route::post('property', 'PropertyController@store');
Route::get('property/{property}', 'PropertyController@show');
Route::get('property/single/{property}', 'PropertyController@single');
Route::delete('property/{property}', 'PropertyController@destroy');

Route::get('property/{property}/weather-events', 'PropertyWeatherController@index');

Route::get('property_search/byCityState', 'PropertySearchController@getCityState');

Route::get('property_search/{city}/{state}', 'PropertySearchController@getPropertiesByCityState');
Route::get('property_search', 'PropertySearchController@getProperties');


Route::get('/testsms', 'HomeController@testsms');

Route::prefix('onboard')->group(function () {
	// Vue Component Routing
	// TODO: refactor to Vue Routing
	// In Laravel until Vue Routing implemented
	Route::get('/register', function(){
		return view('onboard.register');
    })->name('register');

	Route::get('/import', function(){
		return view('onboard.import');
	});
	Route::get('/importing_properties', function(){
		return view('onboard.importing_property_animation');
	});
	Route::get('/notification_settings', function(){
		return view('onboard.notification_settings');
	});
	Route::get('/payment_profile', function(){
		return view('onboard.payment_profile');
	});
	Route::get('/payment_receipt', function(){
		return view('onboard.payment_receipt');
	});
	Route::get('/manual_property_import', function(){
		return view('onboard.manual_property_import');
	});

	//REST Endpoints
    Route::post('user/create', 'OnboardUserController@store');
    Route::post('user/validate', 'OnboardUserController@validateUser');
    Route::post('property_csv_upload', 'BatchPropertyUploadController@store');
    Route::post('property_api_upload', 'BatchPropertyUploadController@api');
    Route::post('verify_working_phone_number', 'OnboardNotifyController@testPhoneNumber');
    Route::post('notify_settings', 'OnboardNotifyController@store');
    Route::post('payment_profile/create', 'OnboardPaymentController@storeStripeToken');
	Route::get('payment_order', 'OnboardPaymentController@total');
    Route::post('make_payment_order', 'OnboardPaymentController@payment');
    Route::get('get_invoices', 'OnboardPaymentController@receipt');
    Route::get('get_import_status', 'OnboardImportController@status');
});

Route::get('notification-settings/before', 'NotificationSettingsController@showBefore');
Route::post('notification-settings/before/update', 'NotificationSettingsController@storeBefore');

Route::get('content/{content}', 'ContentController@index');