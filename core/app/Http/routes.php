<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/',['as'=>'home','uses'=>'HomeController@getHomePage']);
Route::get('/about-us', ['as'=>'about_us', 'uses'=>'HomeController@getAboutUs']);
Route::get('/contact-us', ['as'=>'contact-us', 'uses'=>'HomeController@getContactUs']);
//Authentication Route List
Route::get('auth', ['as'=>'login', 'uses'=>'AdminAuthController@getLogin']);
Route::post('auth', ['as'=>'login', 'uses'=>'AdminAuthController@postLogin']);
Route::get('auth/logout', ['as'=>'logout','uses'=>'AdminAuthController@logout']);

//User Registration Route List
Route::get('user-login', ['as'=>'userlogin', 'uses'=>'UserAuthController@getLogin']);
Route::post('user-login', ['as'=>'user_login', 'uses'=>'UserAuthController@postLogin']);
Route::get('user-reg', ['as'=>'userreg', 'uses'=>'UserAuthController@getRegister']);
Route::post('user-reg', ['as'=>'user_reg', 'uses'=>'UserAuthController@postRegister']);
Route::get('user-logout', ['as'=>'user-logout', 'uses' => 'UserAuthController@logout']);

//Password Change
Route::get('password_change', ['as' => 'password_form', 'uses' => 'PasswordChangeController@getChangePassword']);
Route::post('password_change', ['as' => 'password_form', 'uses' => 'PasswordChangeController@postChangePassword']);

// Dashboard Route List
Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@getDashboard']);

// Base Category Route List
Route::resource('category', 'CategoryController');

// Sub category Route List
Route::resource('subcategory', 'SubCategoryController');

// Question Route List
Route::resource('question', 'QuestionController');

// Question from sub Category Route List
Route::get('questioncat/{id}', ['as' => 'question_subcategory', 'uses' => 'QuestionController@addQuestionById']);
Route::post('questioncat/{id}', ['as' => 'question_store', 'uses' => 'QuestionController@postQuestionById']);
Route::get('questions/{id}', ['as' => 'question_view', 'uses' => 'QuestionController@viewQuestionById']);
Route::get('questionview/{id}', ['as' => 'question_show', 'uses' => 'QuestionController@showQuestionById']);
Route::get('questionedit/{id}/edit', ['as' => 'question_edit', 'uses' => 'QuestionController@editQuestionById']);
Route::put('questionedit/{id}', ['as' => 'question_update', 'uses' => 'QuestionController@updateQuestionById']);
Route::delete('questiondelete/{id}', ['as' => 'question_delete', 'uses' => 'QuestionController@deleteQuestionById']);

// Currency Route List
Route::resource('currency', 'CurrencyController');

// WebSetting Route
Route::get('logo', ['as' => 'logo', 'uses' => 'WebSettingController@getLogo']);
Route::post('logo/{id}', ['as' => 'logo_post', 'uses' => 'WebSettingController@postLogo']);

// Web Title Setting
Route::get('title', ['as'=>'title', 'uses' =>'WebSettingController@getTitle']);
Route::put('title/{id}', ['as'=>'title_update', 'uses' => 'WebSettingController@postTitle']);

// Web Setting Footer Route
Route::get('footer', ['as'=>'footer', 'uses'=>'WebSettingController@getFooter']);
Route::put('footer/{id}', ['as'=>'footer_update', 'uses' => 'WebSettingController@postFooter']);

// Website Setting Slider Route
Route::get('slider', ['as' => 'slider', 'uses' => 'WebSettingController@getSlider']);
Route::post('slider', ['as' => 'slider_post', 'uses' => 'WebSettingController@postSlider']);
Route::delete('slider/{id}', ['as' => 'slider_delete', 'uses' => 'WebSettingController@deleteSlider']);

//Web Setting Offer Route
Route::get('offer', ['as' => 'offer', 'uses' => 'WebSettingController@getOffer']);
Route::put('offer/{id}', ['as' => 'offer_update', 'uses' => 'WebSettingController@putOffer']);

// Web Setting History Route
Route::get('history', ['as' => 'history', 'uses' => 'WebSettingController@getHistory']);

//Web Setting Partner Route List
Route::get('partner', ['as' => 'partner', 'uses' => 'WebSettingController@getPartner']);
Route::post('partner', ['as' => 'partner_post', 'uses' => 'WebSettingController@postPartner']);
Route::delete('partner/{id}', ['as' => 'partner_delete', 'uses' => 'WebSettingController@deletePartner']);

// Web Setting Route Link
Route::get('social', ['as' => 'social', 'uses' => 'WebSettingController@getSocial']);
Route::put('social/{id}', ['as' => 'social_update', 'uses' => 'WebSettingController@putSocial']);

// Web Setting contact Route List
Route::get('contact', ['as' => 'contact', 'uses' => 'WebSettingController@getContact']);
Route::put('contact/{id}', ['as' => 'contact_update', 'uses' => 'WebSettingController@putContact']);

// Route for About Us
Route::get('about', ['as' => 'aboutus', 'uses'=>'WebSettingController@getAbout']);
Route::put('about/{id}', ['as' => 'about_update', 'uses' => 'WebSettingController@putAbout']);

// Route for payment Setting
Route::get('payment', ['as'=>'payment', 'uses'=>'WebSettingController@getPayment']);
Route::put('payment/{id}', ['as'=>'payment_update', 'uses'=>'WebSettingController@putPayment']);

// Route For Exam Category
Route::get('exam/{id}', ['as' => 'exam_id', 'uses' => 'ExamController@getExamById']);
Route::get('exam', ['as' => 'exam', 'uses' => 'ExamController@getExam']);

// Route For Exam Start
Route::get('examstart/{id}', ['as' => 'exam_start', 'uses' => 'ExamStartController@getExamStart']);


Route::get('examconfirm/{id}', ['as'=>'exam_confirm', 'uses' =>'ExamStartController@getExamConfirm']);


Route::get('examineMe/{id}', ['as'=>'lets_exam', 'uses' =>'ExamStartController@LestStartExam']);


Route::post('examineMe/{id}', ['as'=>'lets_exam', 'uses' =>'ExamStartController@FinishExam']);

// Add Fund Route List
Route::get('add-fund', ['as' => 'add_fund', 'uses' => 'FundController@getFund']);

/*Route::post('paypal_ipn', ['as' => 'pp_fund', 'uses' => 'FundController@paypal']);
Route::post('pm_ipn', ['as' => 'pm_fund', 'uses' => 'FundController@pm']);*/

/* user Forget Password */
Route::get('user-forget-password',['as'=>'user-forget-password','uses'=>'HomeController@getForgetPassword']);
Route::get('user-password-reset/{token}',['as'=>'user-password-reset','uses'=>'HomeController@resetForgetPassword']);
Route::post('user-forget-password-submit',['as'=>'user-forget-password-submit','uses'=>'HomeController@submitForgetPassword']);
Route::post('user-reset-password-submit',['as'=>'user-reset-password-submit','uses'=>'HomeController@ResetSubmitPassword']);

/* Admin _Payment Method*/
Route::get('payment-method',['as'=>'payment-method','uses'=>'DashboardController@getPaymentMethod']);
Route::post('payment-method',['as'=>'payment-method','uses'=>'DashboardController@updatePaymentMethod']);

Route::get('favicon',['as'=>'favicon','uses'=>'DashboardController@manageFavicon']);
Route::put('favicon/{id}',['as'=>'favicon_post','uses'=>'DashboardController@postFavicon']);


Route::post('paypal-ipn',['as'=>'paypal-ipn','uses'=>'HomeController@paypalIpn']);
Route::post('perfect-ipn',['as'=>'perfect-ipn','uses'=>'HomeController@perfectIPN']);
Route::post('stripe-preview',['as'=>'stripe-preview','uses'=>'HomeController@stripePreview']);
Route::post('stripe-submit',['as'=>'stripe-submit','uses'=>'HomeController@submitStripe']);
Route::post('btc-preview',['as'=>'btc-preview','uses'=>'HomeController@btcPreview']);
Route::get('btc_ipn/{invoice_id}/{secret}',['as'=>'btc_ipn','uses'=>'HomeController@btcIPN']);




