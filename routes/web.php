<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

/* Front */

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    // return what you want
    return "Clear all thing";
});
// Route::get('/404', function () {
//     redirect(abort(404));
// })->name('404');
Route::get('/sitemap', 'XmlController@index');

Route::get('/', 'IndexController@index');

Route::get('/show-all-categories', 'IndexController@indexCategory');
Route::get('/show-subcats', 'IndexController@indexSubcat');
Route::get('/show-postcode-area-input', 'IndexController@postcodeAreaInput');
Route::get('/search', 'IndexController@search')->name('search');
Route::get('/search-by-ca/{name}/{area}', 'IndexController@searchByCategory');


Route::get('/user-login', 'FrontendUserController@login')->name('front.user.login');
Route::get('/user/create-account', 'FrontendUserController@create')->name('user.create.account');
Route::post('/user/save', 'FrontendUserController@save')->name('user.save');
//Route::get('/trader/create-account', 'TraderController@create')->name('trader.create.account');
Route::post('/trader/store', 'TraderController@save')->name('trader.store');

Route::get('/request-quote/{id}', 'RequestQuoteController@requestQuote')->name('request.quote');
Route::get('/request-quote', 'RequestQuoteController@sendQuote')->name('send.quote');
Route::post('/save-quote', 'RequestQuoteController@saveQuote')->name('save.quote');
Route::post('/delete_record_qoute', 'RequestQuoteController@delete_record_qoute')->name('delete_record_qoute');
Route::get('/user-appointments', 'RequestQuoteController@userAppointments')->name('user.appointments');
Route::get('/user-contacts', 'RequestQuoteController@userContacts')->name('user.contacts');
Route::get('/review', 'ReviewController@index')->name('review');
Route::post('/store-review', 'ReviewController@save')->name('store.review');

//login
Route::post('user-login', 'FrontendUserController@userLogin')->name('post.user.login');
Route::post('trader-login', 'FrontendUserController@traderLogin')->name('post.trader.login');
Route::get('user-profile', 'UserProfileController@index')->name('user.profile');
Route::get('edit-user-profile', 'UserProfileController@editProfile')->name('edit.user.profile');
Route::put('update-user-profile', 'UserProfileController@updateProfile')->name('update.user.profile');
Route::get('delete-user-image/{img_id}', 'UserProfileController@deleteImage')->name('delete.user.image');



Route::get('/a/{country}', 'IndexController@countryStates');
Route::get('/a/{country}/{state}', 'IndexController@stateCounties');
Route::get('/a/{country}/{state}/{county}', 'IndexController@countyCities');
Route::get('/a/{country}/{state}/{county}/{city}', 'IndexController@cityTowns');
Route::get('/get-service-areas', 'IndexController@ajaxServiceArea');

//category search
Route::get('/category/{name}/{area}', 'IndexController@categorySearch');
Route::get('/category/{name}/{country}/{state}', 'IndexController@categorySearch1');
Route::get('/category/{name}/{country}/{state}/{county}', 'IndexController@categorySearch2');
Route::get('/category/{name}/{country}/{state}/{county}/{city}', 'IndexController@categorySearch3');
Route::get('/category/{name}/{country}/{state}/{county}/{city}/{town}', 'IndexController@categorySearch4');



Route::get('/subcategory/{name}/{area}', 'IndexController@subCategorySearch');
Route::get('/subcategory/{name}/{country}/{state}', 'IndexController@subcategorySearch1');
Route::get('/subcategory/{name}/{country}/{state}/{county}', 'IndexController@subcategorySearch2');
Route::get('/subcategory/{name}/{country}/{state}/{county}/{city}', 'IndexController@subcategorySearch3');
Route::get('/subcategory/{name}/{country}/{state}/{county}/{city}/{town}', 'IndexController@subcategorySearch4');


Route::get('get-sub-cats', 'IndexController@subCategorySignup');


Route::get('/traders/{country}', 'IndexController@countryTraders');
Route::get('/traders/{country}/{state}', 'IndexController@stateTraders');
Route::get('/traders/{country}/{state}/{city}', 'IndexController@cityTraders');


Route::get('/a/{country}/{state}/{county}/{city}/{name}', 'IndexController@traders');


Route::get('/ab/{country}/{state}/{postcode}', 'IndexController@postcodeTradersM');
Route::get('/ab/{country}/{state}/{county}/{postcode}', 'IndexController@postcodeTraders');


Route::get('/traders-details/{trader_name}', 'TraderController@traderDetails')->name('trader.details');


Route::get('/job-details/{slug}', 'IndexController@learnMore')->name('learn.more');
Route::get('/apply-now/{slug}', 'IndexController@applyNow')->name('apply.now');
Route::post('/apply-now-submit', 'IndexController@submitApplyNow')->name('apply.now.submit');
Route::resource('/comments', 'CommentsController');


/* Admin */
Auth::routes(['register' => false]);
Route::group(
    ['middleware' => 'auth'],
    function () {

        Route::get('/dashboard', 'HomeController@index')->name('dashboard');
        Route::post('/email_settings_post', 'HomeController@email_settings_post')->name('email_settings_post');
        Route::get('/email_settings', 'HomeController@email_settings')->name('email_settings');
        Route::post('/email_settings_post', 'HomeController@email_settings_post')->name('email_settings_post');

        Route::resource('/posts', 'PostsController');
        Route::resource('/applicants', 'ApplicantsController');

        Route::resource('/departments', 'DepartmentsController');

//      Business Category
        Route::resource('/business-categories', 'BusinessCategoryController');
        Route::post('/business-categories-list', 'BusinessCategoryController@categoryList');
        Route::get('/business-category-edit/{id}', 'BusinessCategoryController@categoryEdit');
        Route::get('/get-towns', 'BusinessCategoryController@getTowns');


//      Business Sub Category
        Route::resource('/business-sub-categories', 'BusinessSubCategoryController');
        Route::post('/business-sub-categories-list', 'BusinessSubCategoryController@dataList');
        Route::get('/business-sub-category-edit/{id}', 'BusinessSubCategoryController@Edit');

//        Business Category Description
        Route::resource('/category-description', 'CategoryDescriptionController');
        Route::post('/category-description-list', 'CategoryDescriptionController@descriptionList');
        Route::get('/create-category-description', 'CategoryDescriptionController@descriptionCreate');
        Route::get('/category-description-edit/{id}', 'CategoryDescriptionController@descriptionEdit');
        Route::get('/category-description-show/{id}', 'CategoryDescriptionController@descriptionShow')->name('category.description.show');

        Route::post('/save-group', 'CategoryDescriptionController@saveGroup');
        Route::get('/activate-group/{category_id}/{id}', 'CategoryDescriptionController@activateGroup');
        Route::get('/delete-group/{id}', 'CategoryDescriptionController@deleteGroup');

//      Country
        Route::resource('/countries', 'CountryController');
        Route::post('/countries-list', 'CountryController@countriesList');
        Route::get('/country-edit/{id}', 'CountryController@countryEdit');

//      State
        Route::resource('/states', 'StateController');
        Route::post('/states-list', 'StateController@statesList');
        Route::get('/state-edit/{id}', 'StateController@stateEdit');

//      County
        Route::resource('/counties', 'CountyController');
        Route::post('/counties-list', 'CountyController@countiesList');
        Route::get('/county-edit/{id}', 'CountyController@countyEdit');

//      Cities
        Route::resource('/cities', 'CityController');
        Route::post('/cities-list', 'CityController@citiesList');
        Route::get('/city-edit/{id}', 'CityController@cityEdit');
        Route::get('/get-county', 'CityController@getCounty');

//      Towns
        Route::resource('/towns', 'TownController');
        Route::post('/towns-list', 'TownController@townsList');
        Route::get('/town-edit/{id}', 'TownController@townEdit');
//        Route::get('/get-county', 'TownController@getCounty');
        Route::get('/get-cities', 'TownController@getCounties');

        Route::resource('/users', 'UsersController');

        Route::get('/profile', 'ProfileSettingsController@profile')->name('profile');
        Route::post('/profile-update', 'ProfileSettingsController@updateProfile')->name('profile-update');
        Route::get('/password-settings', 'ProfileSettingsController@changePassword')->name('change.password');
        Route::post('/password-settings', 'ProfileSettingsController@updatePassword')->name('update-password');


//      About us
        Route::resource('/about-us', 'AboutUsController');
        Route::post('/about-us-list', 'AboutUsController@aboutUsList');
        Route::get('/about-us-edit/{id}', 'AboutUsController@aboutUsEdit');

//      Setting
        Route::resource('/settings', 'SettingsController');
        Route::post('/settings-list', 'SettingsController@settingsList');
        Route::get('/settings-edit/{id}', 'SettingsController@settingsEdit');

        // Datatables
        Route::post('/departments-list', 'DepartmentsController@departmentsList');
        Route::post('/applicants-list', 'ApplicantsController@applicantsList');
        Route::post('/posts-list', 'PostsController@postsList');
        Route::post('/users-list', 'UsersController@usersList');
        Route::post('/users-list_2', 'UsersController@usersList_2');
        Route::post('/users-get-email-status', 'UsersController@adminsStatusChange');
        Route::get('/user-ratings/{id}', 'UsersController@userRatings');
        Route::get('/delete-rating/{id}', 'UsersController@deleteRating');

//        import export excel
//        Route::get('/file-import','UsersController@importView')->name('import-view');
//        Route::post('/import','UsersController@import')->name('import');
//        Route::get('/export-users','UsersController@exportUsers')->name('export');

//      country  import export excel
        Route::get('/import-excel','ExcelController@importView')->name('import-excel');
        Route::post('/save-import-excel','ExcelController@import')->name('save-import-excel');
        Route::post('/town-import-excel','ExcelController@townImport')->name('town-import-excel');




        Route::get('/country-export','ExcelController@exportCountry')->name('country-export');
        Route::get('/state-export','ExcelController@exportState')->name('state-export');
        Route::get('/county-export','ExcelController@exportCounty')->name('county-export');
        Route::get('/city-export','ExcelController@exportCity')->name('city-export');
        Route::get('/town-export','ExcelController@exportTown')->name('town-export');


        Route::get('/export-excel','ExcelController@exportExcel')->name('export.excel');
        Route::get('/export-url','ExcelController@exportUrl')->name('export.url');
        Route::post('/category-export-excel','ExcelController@exportByCategory')->name('category.export.excel');

    }
);
