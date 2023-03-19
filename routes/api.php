<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\PanApplicationController;
use App\Http\Controllers\Api\OrderController;

Route::group(['middleware'=>['auth:api','localization']], function () {  

});



    /** profile api  **/
	Route::get('getProfile/{user_id}', [LoginController::class, 'profile']);	
	Route::post('signUp', [LoginController::class, 'signUp']);	
	Route::post('googleLogin', [LoginController::class, 'googleLogin']);	
	Route::post('resetPass', [LoginController::class, 'resetPass']);	
	Route::post('forgetPass', [LoginController::class, 'forgetPass']);	
	Route::post('update-profile', [LoginController::class, 'update']);	
	Route::post('register', [RegisterController::class, 'register']);
    Route::post('mobile_verified', [RegisterController::class, 'mobile_verified']);
    //Route::post('forgot', [RegisterController::class, 'forgot']);
    //Route::post('reset_password', [RegisterController::class, 'reset_password']);
    Route::post('social_login', [RegisterController::class, 'social_login']);
	Route::get('logout', [RegisterController::class, 'logout']);		
    Route::match(['get','post'],'login', [LoginController::class, 'login']); 
    Route::match(['get','post'],'email_subscription', [SettingController::class, 'email_subscription']); 
    Route::match(['get','post'],'chat_text', [SettingController::class, 'chat_text']); 
    Route::match(['get','post'],'user_document', [SettingController::class, 'user_document']); 
    
    Route::match(['get','post'],'contactUs', [SettingController::class, 'contactUs']);
    Route::match(['get','post'],'getSlider', [RegisterController::class, 'getSlider']);
    Route::match(['get','post'],'uploadOrderDocument/{id}/{user_id}', [SettingController::class, 'uploadOrderDocument']);
    Route::match(['get','post'],'orderDocument', [SettingController::class, 'orderDocument']);
    Route::match(['get','post'],'miscellaneousDocument', [SettingController::class, 'miscellaneousDocument']);
    Route::match(['get','post'],'downloadOrderDocuments', [SettingController::class, 'downloadOrderDocuments']);
    
    Route::get('getSetting', [SettingController::class, 'setting']);
    Route::match(['get','post'],'getAbout', [SettingController::class, 'about']);
    Route::match(['get','post'],'getOrderInvoice/{order_id}', [SettingController::class, 'getOrderInvoice']);
    Route::get('getPrivacyPolicy', [SettingController::class, 'privacy_policy']);
    Route::get('getChat/{order_id}', [SettingController::class, 'Chat']);
    Route::get('getBlogDetail/{id}/{user_id}', [SettingController::class, 'blogDetail']);
    Route::get('getServices/{page_name}', [SettingController::class, 'getServices']);
    Route::get('getTermsConditions', [SettingController::class, 'terms_conditions']);
    Route::get('getCalender', [SettingController::class, 'getCalender']);
    Route::get('getContactUs', [SettingController::class, 'contactUs']);
    Route::get('getBlog/{takes}', [SettingController::class, 'blog']);
    Route::post('getCoupon', [SettingController::class, 'getCoupon']);
    Route::post('userGstinDetails', [SettingController::class, 'userGstinDetails']);
    Route::get('getNotification', [SettingController::class, 'getNotification']);
    Route::get('getEvent', [SettingController::class, 'getEvent']);
    Route::post('getServiceDetail', [SettingController::class, 'getServiceDetail']);
    /*Route::post('documentUpload', [SettingController::class, 'documentUpload']);*/
    Route::get('getFaq/{page_name}', [SettingController::class, 'getFaq']);
    Route::post('editProfileImage', [SettingController::class, 'editProfileImage']);
    Route::post('getContacts', [SettingController::class, 'getContacts']);
    Route::post('getComments', [SettingController::class, 'getComments']);
    Route::post('unsubscribe', [SettingController::class, 'unsubscribe']);
    Route::post('editProfile', [SettingController::class, 'editProfile']);
    Route::post('profileData', [SettingController::class, 'profileData']);
    Route::post('orderPurchased', [SettingController::class, 'orderPurchased']);
    Route::get('getService', [SettingController::class, 'service']);
    Route::get('getOrderList/{user_id}', [SettingController::class, 'getOrderList']);
    Route::get('getReferralCode/{user_id}', [SettingController::class, 'getReferralCode']);
    Route::get('getOurClints', [SettingController::class, 'our_clints']);
    Route::get('getStates', [SettingController::class, 'getStates']);
    Route::get('getCitys', [SettingController::class, 'getCitys']);
    Route::post('userPersonalInfo', [SettingController::class, 'userPersonalInfo']);
    Route::post('userBank', [SettingController::class, 'userBank']);
    Route::post('userAddress', [SettingController::class, 'userAddress']);
    Route::post('getServiceName', [SettingController::class, 'getServiceName']);
    Route::post('getUserAddress', [SettingController::class, 'getUserAddress']);
    Route::get('getServiceType/{service_type_id}', [SettingController::class, 'getServiceType']);
      Route::match(['get','post'],'blogLikes', [SettingController::class, 'blogLikes']);
      Route::match(['get','post'],'blogShared', [SettingController::class, 'blogShared']);

    Route::get('getServicesName', [SettingController::class, 'getServicesName']);
    Route::get('getMyDocuments/{user_id}', [SettingController::class, 'getMyDocuments']);
    Route::post('docTypeMatch', [SettingController::class, 'docTypeMatch']);
    Route::post('getUserInfo', [SettingController::class, 'getUserInfo']);
    Route::post('getUserBank', [SettingController::class, 'getUserBank']);
    Route::post('getReferral', [SettingController::class, 'getReferral']);
    Route::get('trackOrder/{id}/{user_id}', [SettingController::class, 'trackOrder']);
    Route::get('deleteOrder/{id}/{user_id}', [SettingController::class, 'deleteOrder']);
    Route::get('getServicesTypes/{type_id}', [SettingController::class, 'getServicesTypes']);
    Route::get('getServicesTypesDropdown/{dropdown_id}', [SettingController::class, 'getServicesTypesDropdown']);
    Route::post('orderPaymentStatus', [OrderController::class, 'orderPaymentStatus']);
    Route::post('getOrderPaymentStatus', [OrderController::class, 'getOrderPaymentStatus']);
    Route::post('orderDetail', [OrderController::class, 'orderDetail']);
    Route::post('getWallet', [SettingController::class, 'getWallet']);
    Route::post('panAppSubmit', [PanApplicationController::class, 'panAppSubmit']);
    Route::post('orderFilter', [OrderController::class, 'orderFilter']);
    

    
    
