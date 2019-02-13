<?php

/*
|--------------------------------------------------------------------------
| Web ADMIN Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('change/lang/{locale}',  'Admin\HomeController@changeLang')->where('locale', '(az)|(en)|(ru)')->name('change_lang');

// if user login
Route::group(['middleware' => ['lang', 'auth:web']],function (){
    Route::get('/logout','Auth\LoginController@logout')->name('admin.logout');

    Route::get('/','Admin\HomeController@index')->name('admin.home')->middleware('priv:admin.home,'.\App\Helper\Standarts::PRIV_CAN_SEE);
    //msk routes
    Route::group(['prefix' => 'msk'],function(){
        Route::get('/category','Admin\Msk\CategoryController@index')->name('admin.category')->middleware('priv:admin.category,'.\App\Helper\Standarts::PRIV_CAN_SEE);
        Route::post('/category/add_edit','Admin\Msk\CategoryController@addEditAction')->name('admin.category.add_edit')->middleware('priv:admin.category,'.\App\Helper\Standarts::PRIV_CAN_EDIT);
        Route::post('/sub_category/add_edit','Admin\Msk\CategoryController@addEditSubCategoryAction')->name('admin.sub_category.add_edit')->middleware('priv:admin.category,'.\App\Helper\Standarts::PRIV_CAN_EDIT);
        Route::get('/category/delete/{id}','Admin\Msk\CategoryController@deleteAction')->name('admin.category.delete')->middleware('priv:admin.category,'.\App\Helper\Standarts::PRIV_CAN_EDIT);
        Route::get('/category/load_page','Admin\Msk\CategoryController@loadPage')->name('admin.category.load_page')->middleware('priv:admin.category,'.\App\Helper\Standarts::PRIV_CAN_SEE);
        Route::get('/sub_category/delete/{id}','Admin\Msk\CategoryController@deleteSubCategoryAction')->name('admin.sub_category.delete')->middleware('priv:admin.category,'.\App\Helper\Standarts::PRIV_CAN_EDIT);
        Route::get('/category/sub_load_page','Admin\Msk\CategoryController@SubloadPage')->name('admin.category.sub_load_page')->middleware('priv:admin.category,'.\App\Helper\Standarts::PRIV_CAN_SEE);
        Route::get('/sub_sub_category/delete/{id}','Admin\Msk\CategoryController@deleteSubSubCategoryAction')->name('admin.sub_sub_category.delete')->middleware('priv:admin.category,'.\App\Helper\Standarts::PRIV_CAN_EDIT);
        Route::post('/sub_sub_category/add_edit','Admin\Msk\CategoryController@addEditSubSubCategoryAction')->name('admin.sub_sub_category.add_edit')->middleware('priv:admin.category,'.\App\Helper\Standarts::PRIV_CAN_EDIT);


        // country and city msk routes
        Route::get('/country','Admin\Msk\CountryAndCityController@index')->name('admin.country_city')->middleware('priv:admin.country_city,'.\App\Helper\Standarts::PRIV_CAN_SEE);
        Route::post('/country/add_edit','Admin\Msk\CountryAndCityController@addEditAction')->name('admin.country.add_edit')->middleware('priv:admin.country_city,'.\App\Helper\Standarts::PRIV_CAN_EDIT);
        Route::post('/city/add_edit','Admin\Msk\CountryAndCityController@addEditCityAction')->name('admin.city.add_edit')->middleware('priv:admin.country_city,'.\App\Helper\Standarts::PRIV_CAN_EDIT);
        Route::get('/country/delete/{id}','Admin\Msk\CountryAndCityController@deleteAction')->name('admin.country.delete')->middleware('priv:admin.country_city,'.\App\Helper\Standarts::PRIV_CAN_EDIT);
        Route::get('/country/load_page','Admin\Msk\CountryAndCityController@loadPage')->name('admin.country.load_page')->middleware('priv:admin.country_city,'.\App\Helper\Standarts::PRIV_CAN_SEE);
        Route::get('/city/delete/{id}','Admin\Msk\CountryAndCityController@deleteCityAction')->name('admin.city.delete')->middleware('priv:admin.country_city,'.\App\Helper\Standarts::PRIV_CAN_EDIT);


        // auction status routes
        Route::get('/auction_status','Admin\Msk\AuctionStatusController@index')->name('admin.auction_status')->middleware('priv:admin.auction_status,'.\App\Helper\Standarts::PRIV_CAN_SEE);
        Route::post('/auction_status/add_edit','Admin\Msk\AuctionStatusController@addEditAction')->name('admin.auction_status.add_edit')->middleware('priv:admin.auction_status,'.\App\Helper\Standarts::PRIV_CAN_EDIT);
        Route::get('/auction_status/delete/{id}','Admin\Msk\AuctionStatusController@deleteAction')->name('admin.auction_status.delete')->middleware('priv:admin.auction_status,'.\App\Helper\Standarts::PRIV_CAN_EDIT);

        // user status routes
        Route::get('/user_status','Admin\Msk\UserStatusController@index')->name('admin.user_status')->middleware('priv:admin.user_status,'.\App\Helper\Standarts::PRIV_CAN_SEE);
        Route::post('/user_status/add_edit','Admin\Msk\UserStatusController@addEditAction')->name('admin.user_status.add_edit')->middleware('priv:admin.user_status,'.\App\Helper\Standarts::PRIV_CAN_EDIT);
        Route::get('/user_status/delete/{id}','Admin\Msk\UserStatusController@deleteAction')->name('admin.user_status.delete')->middleware('priv:admin.user_status,'.\App\Helper\Standarts::PRIV_CAN_EDIT);

        //user privs routes
        Route::get('/privs','Admin\Msk\PrivController@index')->name('admin.priv')->middleware('priv:admin.priv,'.\App\Helper\Standarts::PRIV_CAN_SEE);
        Route::get('/privs/add_edit/{id}','Admin\Msk\PrivController@addEditModal')->name('admin.priv.add_edit')->middleware('priv:admin.priv,'.\App\Helper\Standarts::PRIV_CAN_SEE);
        Route::post('/privs/add_edit/{id}','Admin\Msk\PrivController@addEditAction')->name('admin.priv.add_edit_action')->middleware('priv:admin.priv,'.\App\Helper\Standarts::PRIV_CAN_EDIT);

        //admin select2
        Route::get('/admin_select2','Admin\Select2Controller@index')->name('admin.select2');


        //Sliders
        Route::get('/slider', 'Admin\Msk\SliderController@index')->name('admin.slider')->middleware('priv:admin.slider,'.\App\Helper\Standarts::PRIV_CAN_SEE);
        Route::get('/slider/slider_add_edit/{id?}', 'Admin\Msk\SliderController@addEditSlider')->name('admin.slider.slider_add_edit')->middleware('priv:admin.slider,'.\App\Helper\Standarts::PRIV_CAN_SEE);
        Route::post('/slider/slider_add_edit/{id?}', 'Admin\Msk\SliderController@addEditSliderProcess')->name('admin.slider.slider_add_edit')->middleware('priv:admin.slider,'.\App\Helper\Standarts::PRIV_CAN_SEE);
        Route::post('/slider/delete', 'Admin\Msk\SliderController@sliderDelete')->name('admin.slider.delete')->middleware('priv:admin.slider,'.\App\Helper\Standarts::PRIV_CAN_SEE);
        Route::post('/slider/checked', 'Admin\Msk\SliderController@sliderChecked')->name('admin.slider.checked')->middleware('priv:admin.slider,'.\App\Helper\Standarts::PRIV_CAN_SEE);
    });

    // admin.users routes
    Route::get('/users','Admin\UserController@index')->name('admin.users')->middleware('priv:admin.users,'.\App\Helper\Standarts::PRIV_CAN_SEE);
    Route::get('/users/add_edit/{id}','Admin\UserController@addEditModal')->name('admin.users.ad_edit')->middleware('priv:admin.users,'.\App\Helper\Standarts::PRIV_CAN_SEE);
    Route::post('/users/add_edit/{id}','Admin\UserController@addEditAction')->name('admin.users.add_edit_action')->middleware('priv:admin.users,'.\App\Helper\Standarts::PRIV_CAN_EDIT);

    // auction routes
    Route::get('/auction','Admin\AuctionController@index')->name('admin.auction')->middleware('priv:admin.auction,'.\App\Helper\Standarts::PRIV_CAN_SEE);
    Route::get('/auction/add_edit/{id}','Admin\AuctionController@editModal')->name('admin.auction.add_edit')->middleware('priv:admin.auction,'.\App\Helper\Standarts::PRIV_CAN_SEE);
    Route::post('/auction/add_edit/{id}','Admin\AuctionController@addEditAuction')->name('admin.auction.add_edit_auction')->middleware('priv:admin.auction,'.\App\Helper\Standarts::PRIV_CAN_EDIT);

    //auction Filter
    Route::get('/auction/filter', 'Admin\AuctionController@openFilterModal')->name('admin.auction.filter');

    //auction reject
    Route::post('/auction/reject', 'Admin\AuctionController@rejectAuction')->name('admin.auction.reject');

    //auction show
    Route::get('/auction/show/{id}', 'Admin\AuctionController@showAuction')->name('admin.auction.show');

    //auction confirm
    Route::post('/auction/confirm', 'Admin\AuctionController@confirmAuction')->name('admin.auction.confirm');

    //documentation
    Route::get('/doc', 'Admin\DocumentationController@index')->name('admin.doc')->middleware('priv:admin.doc,'.\App\Helper\Standarts::PRIV_CAN_SEE);
    Route::get('/doc/add_edit/{id?}', 'Admin\DocumentationController@addEditDoc')->name('admin.doc.add_edit');
    Route::post('/doc/add_edit/{id?}', 'Admin\DocumentationController@addEditDocProcess')->name('admin.doc.add_edit');
    Route::post('/doc/delete', 'Admin\DocumentationController@delete')->name('admin.doc.delete');
});


// if user not login
Route::group(['middleware' => ['guest:web']],function(){
    Route::get('/login','Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login','Auth\LoginController@login')->name('admin.login.process');
});
