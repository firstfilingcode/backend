<?php
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::get('/', function () {
        return view('admin.auth.login');
    })->name('admin.auth.login');    
 Route::match(['get','post'],'logout','UserController@logout')->name('logout');
    //Auth::routes(['verify' => true]);
	Auth::routes();
});

   


Route::group(['namespace' => 'Admin', 'as' => 'admin.','middleware'=>['auth:admin-web','preventBackHistory']], function () {
	Route::any('/change_password/', [ 'as' => 'users.change_password', 'uses' => 'UserController@change_password']);
	Route::get('/home', 'HomeController@index')->name('admin.home');

   	Route::resource('settings', SettingsController::class);	
   	
    //RmController
    Route::resource('rm', RmController::class);
    Route::match(['get','post'],'rm/status','RmController@change_status')->name('rm.status');
    Route::match(['get','post'],'rm/destroy','RmController@destroy')->name('rm.destroy');
    
    //CostumarController
    Route::resource('costumar', CostumarController::class);
    Route::match(['get','post'],'costumar/status','CostumarController@change_status')->name('costumar.status');
    Route::match(['get','post'],'costumar/destroy','CostumarController@destroy')->name('costumar.destroy');
    
    //CaController
	Route::resource('ca', CaController::class);
    Route::match(['get','post'],'ca/status','CaController@change_status')->name('ca.status');
    Route::match(['get','post'],'ca/destroy','CaController@destroy')->name('ca.destroy');
    
    //OrderPriorityController
    	Route::resource('order_priority', OrderPriorityController::class);
    Route::match(['get','post'],'order_priority/status','OrderPriorityController@change_status')->name('order_priority.status');

    
    
    //NotificationController
	Route::resource('notification', NotificationController::class);
    Route::match(['get','post'],'notification/status','NotificationController@change_status')->name('notification.status');
    Route::match(['get','post'],'notification/destroy','NotificationController@destroy')->name('notification.destroy');
    
    //UserController
    Route::resource('users', UserController::class);
    Route::match(['get','post'],'users/status','UserController@change_status')->name('users.status');
    Route::match(['get','post'],'users/destroy','UserController@destroy')->name('users.destroy');
    Route::match(['get','post'],'ca_permission','UserController@ca_permission')->name('ca_permission');
    Route::match(['get','post'],'user_side_per','UserController@userSidePer')->name('user_side_per');
    

    //ServiceDocumentController
    Route::resource('service_document', ServiceDocumentController::class);
    Route::match(['get','post'],'service_document/status','ServiceDocumentController@change_status')->name('service_document.status');
    Route::match(['get','post'],'service_document/destroy','ServiceDocumentController@destroy')->name('service_document.destroy');
    Route::match(['get','post'],'service_documentdeleteAll','ServiceDocumentController@service_documentdeleteAll')->name('service_documentdeleteAll');


    //ServiceController
    Route::resource('service', ServiceController::class);
    Route::match(['get','post'],'service/status','ServiceController@change_status')->name('service.status');
    Route::match(['get','post'],'service/destroy','ServiceController@destroy')->name('service.destroy');
    Route::match(['get','post'],'service_type_status/','ServiceController@service_type_status')->name('service_type_status');
    Route::match(['get','post'],'service_routes/{id}','ServiceController@service_routes')->name('service_routes');


    //service_type
    Route::resource('service_type', ServiceTypeController::class);
    Route::match(['get','post'],'service_type/status','ServiceTypeController@service_type')->name('service_type.status');
    Route::match(['get','post'],'service_type/destroy','ServiceTypeController@destroy')->name('service_type.destroy');
    
    //service_type_dropdown
    Route::resource('service_type_dropdown', ServiceTypeDropdownController::class);
    Route::match(['get','post'],'service_type_dropdown/status','ServiceTypeDropdownController@service_type_dropdown')->name('service_type_dropdown.status');
    Route::match(['get','post'],'service_type_dropdown/destroy','ServiceTypeDropdownController@destroy')->name('service_type_dropdown.destroy');
    
        //service_Sub_type
    Route::resource('service_sub_type', ServiceSubTypeController::class);
    Route::match(['get','post'],'service_sub_type/status','ServiceSubTypeController@service_sub_type')->name('service_sub_type.status');
    Route::match(['get','post'],'service_sub_type/destroy','ServiceSubTypeController@destroy')->name('service_sub_type.destroy');
    Route::match(['get','post'],'Search_service_Sub_type/{id}','ServiceSubTypeController@Search_service_Sub_type')->name('Search_service_Sub_type');

    //BlogController
    Route::resource('blog', BlogController::class);
    Route::match(['get','post'],'blog/status','BlogController@change_status')->name('blog.status');
    Route::match(['get','post'],'blog/destroy','BlogController@destroy')->name('blog.destroy');
    //SliderController
    Route::resource('slider', SliderController::class);
    Route::match(['get','post'],'slider/status','SliderController@change_status')->name('slider.status');
    Route::match(['get','post'],'slider/destroy','SliderController@destroy')->name('slider.destroy');
    
    // Profile
    Route::get('/profile','UserController@profile')->name('admin-profile');
    Route::match(['get','post'],'profile/status','UserController@change_status')->name('profile.status');
    Route::post('/profile-update/{id}','UserController@profileUpdate');
    
    //RoleController
    Route::resource('roles', RoleController::class);
    Route::match(['get','post'],'roles/destroy','RoleController@destroy')->name('roles.destroy');
    
    Route::resource('routes', RouteController::class); 
        Route::match(['get','post'],'routes/destroy','RouteController@destroy')->name('routes.destroy');

    
    //Sales_departmentController
    Route::resource('sales_department', Sales_departmentController::class);
    Route::match(['get','post'],'sales_department/destroy/{id}','Sales_departmentController@destroy')->name('sales_department.destroy');
    
    // OfferController
    Route::resource('offer', OfferController::class);
    Route::match(['get','post'],'offer/status','OfferController@change_status')->name('offer.status');
    Route::match(['get','post'],'offer/destroy','OfferController@destroy')->name('offer.destroy');
    
    // ClintsController
    Route::resource('clints', ClintsController::class);
    Route::match(['get','post'],'clints/status','ClintsController@change_status')->name('clints.status');
    Route::match(['get','post'],'clints/destroy','ClintsController@destroy')->name('clints.destroy');
    
    // CouponController
    Route::resource('coupon', CouponController::class);
    Route::match(['get','post'],'coupon/status','CouponController@change_status')->name('coupon.status');
    Route::match(['get','post'],'coupon/destroy','CouponController@destroy')->name('coupon.destroy');
    
    // WebMetaController
    Route::resource('web_meta', WebMetaController::class);
    Route::match(['get','post'],'web_meta/status','WebMetaController@change_status')->name('web_meta.status');
    Route::match(['get','post'],'web_meta/destroy','WebMetaController@destroy')->name('web_meta.destroy');
    
    // NewsLettersController
    Route::resource('news_letters', NewsLettersController::class);
    Route::match(['get','post'],'news_letters/status','NewsLettersController@change_status')->name('news_letters.status');
    
    
    // WalletController
    Route::resource('wallet', WalletController::class);
    Route::match(['get','post'],'wallet/status','WalletController@change_status')->name('wallet.status');
    
    // RewardController
    Route::resource('wallet_settings', WalletSettingController::class);

    // PrivacyPolicyController
    Route::resource('privacy_policy', PrivacyPolicyController::class);
    
    // TermsConditionController
    Route::resource('terms_condition', TermsConditionController::class);
  
    // FaqController
    Route::resource('faq', FaqController::class);
    Route::match(['get','post'],'faq/status','FaqController@change_status')->name('faq.status');
    Route::match(['get','post'],'faq/destroy','FaqController@destroy')->name('faq.destroy');
    // AboutController
    Route::resource('about', AboutController::class);
  
    // ReferEarnController
    Route::resource('refer_earn', ReferEarnController::class);
    
    // MassageController
    Route::resource('massage', MassageController::class);
  
    // contactController
    Route::resource('contacts', ContactContainer::class);
    
    // expenseController
    Route::resource('expense', ExpenseController::class);
    Route::match(['get','post'],'expense/status','ExpenseController@change_status')->name('expense.status');
    Route::match(['get','post'],'expense/destroy','ExpenseController@destroy')->name('expense.destroy');
    
    //calendar
     Route::resource('calendar', CalendarController::class);
    Route::match(['get','post'],'calendar/status','CalendarController@change_status')->name('calendar.status');
    Route::match(['get','post'],'calendar/destroy','CalendarController@destroy')->name('calendar.destroy');
    
    // OrderController
    Route::match(['get','post'],'order','OrderController@index')->name('order');
     Route::match(['get','post'],'order_edit/{id}','OrderController@order_edit')->name('order_edit');
    Route::match(['get','post'],'order/status','OrderController@change_status')->name('order.status');
    Route::match(['get','post'],'emails/news_letter','OrderController@news_letter')->name('emails.news_letter');
    Route::match(['get','post'],'order/destroy/{id}','OrderController@destroy')->name('order.destroy');
    Route::match(['get','post'],'payment','OrderController@payment')->name('payment');
    Route::match(['get','post'],'invoice/status','OrderController@invoice_status')->name('invoice.status');
    Route::match(['get','post'],'payment/status','OrderController@payment_status')->name('payment.status');
    Route::match(['get','post'],'private_comment','OrderController@private_comment')->name('private.comment');
    Route::match(['get','post'],'admin_Remove_DOCUMENTS/{id}','OrderController@remove_DOCUMENTS')->name('admin_Remove_DOCUMENTS');
    Route::match(['get','post'],'CaseOnHold','OrderController@CaseOnHold')->name('CaseOnHold');
    Route::match(['get','post'],'update_old_status','OrderController@update_old_status')->name('update_old_status');

    Route::match(['get','post'],'order_add','OrderController@order_add')->name('order_add');
    Route::match(['get','post'],'order_details/{id}','OrderController@order_details')->name('details');
    Route::match(['get','post'],'service_type_data/{id}','OrderController@serviceTypeData')->name('service_type_data');;
    Route::match(['get','post'],'service_detail/{id}','OrderController@serviceDetailData')->name('service_detail');;
    Route::match(['get','post'],'pending_order','OrderController@pending_order')->name('pending_order');

    
    //BranchController
    Route::resource('branch', BranchController::class);
    Route::match(['get','post'],'branch/status','BranchController@change_status')->name('branch.status');
    Route::match(['get','post'],'branch/destroy','BranchController@destroy')->name('branch.destroy');
    
    
    //NewsEventController
    Route::resource('news_events', NewsEventController::class);
    Route::match(['get','post'],'news_events/status','NewsEventController@change_status')->name('news_events.status');
    Route::match(['get','post'],'news_events/destroy','NewsEventController@destroy')->name('news_events.destroy');
    
    //EmailTemplateController
        Route::resource('templete_view', EmailTemplateController::class);
        Route::match(['get','post'],'templete_view/destroy','EmailTemplateController@destroy')->name('templete_view.destroy');

    
    //Status
     Route::resource('order_status', StatusController::class);
     Route::match(['get','post'],'order_status/status','StatusController@change_status')->name('order_status.status');
     Route::match(['get','post'],'order_status/destroy','StatusController@destroy')->name('order_status.destroy');
    
    //CAManagementController
    Route::match(['get','post'],'ca_payment','Ca\CAManagementController@ca_payment')->name('ca_payment');
    Route::match(['get','post'],'ca_find_orders','Ca\CAManagementController@ca_find_orders')->name('ca_find_orders');
    Route::match(['get','post'],'ca_view_order/{id}','Ca\CAManagementController@ca_view_order')->name('ca_view_order');
    Route::match(['get','post'],'messageSend','Ca\CAManagementController@message_send')->name('messageSend');
    Route::match(['get','post'],'statusComment','Ca\CAManagementController@status_comment')->name('statusComment');
    Route::match(['get','post'],'orderPriority','Ca\CAManagementController@order_priority')->name('orderPriority');
    Route::match(['get','post'],'orderCaseType','Ca\CAManagementController@order_case_type')->name('orderCaseType');
    Route::match(['get','post'],'PrivateComment','Ca\CAManagementController@private_comment')->name('PrivateComment');
    Route::match(['get','post'],'acknowledgementNo','Ca\CAManagementController@acknowledgement_no')->name('acknowledgementNo');
    Route::match(['get','post'],'documentRequest','Ca\CAManagementController@document_request')->name('documentRequest');
    Route::match(['get','post'],'updateRm','Ca\CAManagementController@update_rm')->name('updateRm');
    Route::match(['get','post'],'updateCa','Ca\CAManagementController@update_ca')->name('updateCa');
    Route::match(['get','post'],'reimbursementUpload','Ca\CAManagementController@reimbursement_upload')->name('reimbursementUpload');
    Route::match(['get','post'],'InvoiceUpload','Ca\CAManagementController@invoice_upload')->name('InvoiceUpload');

    Route::match(['get','post'],'downloadReimbursement/{id}','Ca\CAManagementController@download_reimbursement')->name('downloadReimbursement');
    Route::match(['get','post'],'acknowledgementAllView','Ca\CAManagementController@acknowledgement_all_view')->name('acknowledgementAllView');
    Route::match(['get','post'],'download_DOCUMENTS/{id}','Ca\CAManagementController@download_DOCUMENTS')->name('download_DOCUMENTS');
    Route::match(['get','post'],'Remove_DOCUMENTS/{id}','Ca\CAManagementController@Remove_DOCUMENTS')->name('Remove_DOCUMENTS');
    Route::match(['get','post'],'DoumentsSent','Ca\CAManagementController@DoumentsSent')->name('DoumentsSent');
    Route::match(['get','post'],'downloadDoumentsSendByClient/{id}','Ca\CAManagementController@downloadDoumentsSendByClient')->name('downloadDoumentsSendByClient');
    Route::match(['get','post'],'admin_Remove_DoumentsSendByClient/{id}','Ca\CAManagementController@admin_Remove_DoumentsSendByClient')->name('admin_Remove_DoumentsSendByClient');
    Route::match(['get','post'],'CaApprovalStatus','Ca\CAManagementController@ca_approval_status')->name('CaApprovalStatus');
    Route::match(['get','post'],'downloadInvoice/{id}','Ca\CAManagementController@download_invoice')->name('downloadInvoice');


//
  Route::match(['get','post'],'wallet_settings','WalletsettingsController@wallet_settings')->name('wallet_settings');
  Route::match(['get','post'],'wallet_settings_edit/{id}','WalletsettingsController@wallet_settings_edit')->name('wallet_settings_edit');
    
    
});

