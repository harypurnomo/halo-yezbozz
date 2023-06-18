<?php

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

//Public Group
Route::group(['prefix' => '','middleware' => ['web']], function () {

     // homepage
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('{lang}/home', 'HomeController@langHome')->name('lang.home');

    // Shop
    Route::get('{lang}/shop', 'HomeController@langShop')->name('lang.shop');

    // About
    Route::get('{lang}/about', 'HomeController@langAbout')->name('lang.about');
    
    // Blog
    Route::get('{lang}/blog', 'HomeController@langBlog')->name('lang.blog');
    Route::get('{lang}/blog/{slug}', 'HomeController@langBlogDetail')->name('lang.blog.detail');

    //contact us
    Route::get('{lang}/contact-us', 'HomeController@langContactUs')->name('lang.contactus');
    Route::post('contact-us', 'HomeController@SubmitContactUs')->name('lang.contactus.submit');

    // Subscribe
    Route::post('subscribe', 'HomeController@subscribes')->name('subscribe');
    
    // authpage
    // sign in
    Route::get('{lang}/sign-in', 'HomeController@langSignIn')->name('lang.signin');
    Route::post('{lang}/sign-in', 'Auth\SessionController@login')->name('post.signin')->middleware("throttle:10,2");
    // forgot password
    Route::get('{lang}/forgot-password', 'HomeController@langForgotPassword')->name('lang.forgotpassword');
    Route::post('{lang}/forgot-password', 'Auth\SessionController@forgot_password')->name('post.forgot.password');
    Route::get('{lang}/reset-password/{id}/{token}', 'Auth\SessionController@forgot_password_form')->name('reset.password.form');
    Route::post('forgot-password-action','Auth\SessionController@forgot_password_action')->name('post.reset.password.form');
    // sign up
    Route::get('{lang}/sign-up', 'HomeController@langSignUp')->name('lang.signup');
    Route::post('{lang}/sign-up', 'Auth\SessionController@register')->name('post.signup');
    Route::get('activate-user/{id}/{token}','Auth\SessionController@activate_user')->name('activate.request');
    // sing up google
    Route::get('{lang}/sign-up-google', 'Auth\SessionController@langGoogleSignUp')->name('lang.google.signup');
    Route::get('sign-up-google/redirect', 'Auth\SessionController@langGoogleSignUpRedirect')->name('lang.google.signup.redirect');
    Route::post('sign-up-google', 'Auth\SessionController@langGoogleSignUpAction')->name('lang.google.signup.action');

    // success page
    Route::get('{lang}/success-message', 'HomeController@langSuccessMessage')->name('lang.successmessage');

    // log out
    Route::get('logout', 'Auth\SessionController@logout')->name('logout');

    // Broadcast
    Route::get('broadcast', 'BroadcastController@broadcast')->name('broadcast');

    Route::get('/login', function () {
        return redirect(route('lang.signin',['lang'=>'en']));
    })->name('login');
    
    // URL Tracker
    Route::get('url-tracker', 'TrackController@index')->name('url.tracker');
});

//Admin Group
Route::group(['prefix' => 'administrator', 'middleware' => 'auth'], function() {

    // Personal Information 
    Route::get('profile','Admin\Profile\SessionController@info')->name('profile');
    Route::post('profile','Admin\Profile\SessionController@update_info')->name('update.personal.info');
    Route::post('profile/specific-info','Admin\Profile\SessionController@update_specific_info')->name('update.specific.info');
    Route::get('profile/change-password','Admin\Profile\SessionController@change_password')->name('change.password');
    Route::post('profile/change-password','Admin\Profile\SessionController@change_password_action')->name('change.password.action');

    Route::get('dashboard', 'Admin\Dashboard\DashboardController@index')->name('dashboard');
    Route::get('traffic-analytics', 'Admin\TrafficAnalytic\TrafficAnalyticController@index')->name('traffic.analytics');
    
    // User Management
    // Manage Users
    Route::resource('master-user', 'Admin\UserManagement\UserController');
    Route::get('resent-verification-code/{id}', 'Admin\UserManagement\UserController@sentCode')->name('resent.verification.code');
    // Master Group
    Route::resource('master-group', 'Admin\Group\GroupController');
    // Manage Modules
    Route::resource('master-module', 'Admin\Module\ModuleController');
    // Manage Users Type
    Route::resource('master-type', 'Admin\UserType\UserTypeController');

    //Articles
    Route::resource('master-article', 'Admin\Article\ArticleController');
    Route::post('master-article/optional','Admin\Article\ArticleController@update_optional')->name('update.article.optional');
    Route::post('master-article/seo','Admin\Article\ArticleController@update_seo')->name('update.article.seo');
    Route::get('master-article-delete/{id}', 'Admin\Article\ArticleController@deleteFile')->name('master.article.delete');
    Route::resource('master-category-of-article', 'Admin\ArticleCategory\ArticleCategoryController');

    //Contact Us
    Route::resource('master-contactus', 'Admin\ContactUs\ContactUsController');

    //Subscriber
    Route::resource('master-subscribe', 'Admin\Subscribe\SubscribeController');

    //Testimonials
    Route::resource('master-testimonial', 'Admin\Testimonial\TestimonialController');

    //Web Settings
    Route::resource('master-company-profile', 'Admin\CompanyProfile\CompanyProfileController');
    Route::resource('master-seo', 'Admin\Seo\SeoController');
    Route::resource('master-google-analytics', 'Admin\GoogleAnalytics\GoogleAnalyticsController');
    Route::resource('master-banner', 'Admin\Banner\BannerController');
    Route::resource('master-patner', 'Admin\Patner\PatnerController');
    Route::resource('master-facilities', 'Admin\Facilities\FacilitiesController');
    Route::resource('master-team', 'Admin\Team\TeamController');

    //Pages
    Route::resource('master-page', 'Admin\Page\PageController');

    //Tenants
    Route::resource('master-tenant', 'Admin\Tenant\TenantController');
    Route::post('master-tenant/update-optional/{id}', 'Admin\Tenant\TenantController@update_optional')->name('master.tenant.update.optional');
    Route::resource('master-tenant-by-me', 'Admin\Tenant\TenantByMeController');
    Route::resource('master-tenant-representative', 'Admin\TenantRepresentative\TenantRepresentativeController');
    Route::resource('master-type-of-tenant', 'Admin\TenantCategory\TenantCategoryController');

    //Events
    Route::resource('master-event', 'Admin\Event\EventController');
    Route::get('master-event-delete/{id}', 'Admin\Event\EventController@deleteFile')->name('master.event.delete');
    Route::resource('master-category-of-event', 'Admin\EventCategory\EventCategoryController');

    //MarketPlace
    Route::resource('master-market', 'Admin\Market\MarketController');
    Route::get('master-market-delete/{id}', 'Admin\Market\MarketController@deleteFile')->name('master.market.delete');
    Route::resource('master-category-of-market', 'Admin\MarketCategory\MarketCategoryController');

    //Heldesk
    Route::resource('open-ticket', 'Admin\Helpdesk\HelpdeskController');
    Route::get('status-open-ticket\{id}\{is_active}', 'Admin\Helpdesk\HelpdeskController@statusChange')->name('status.open.ticket');
    Route::resource('open-ticket-by-me', 'Admin\Helpdesk\HelpdeskByMeController');
    Route::get('open-ticket/reply-message/{id}', 'Admin\Helpdesk\HelpdeskController@reply')->name('open-ticket.reply');
    Route::get('open-ticket-by-me/reply-message/{id}', 'Admin\Helpdesk\HelpdeskByMeController@reply')->name('open-ticket-by-me.reply');
    Route::resource('master-category-of-helpdesk', 'Admin\HelpdeskCategory\HelpdeskCategoryController');
    Route::resource('master-priority-of-helpdesk', 'Admin\HelpdeskPriority\HelpdeskPriorityController');

    //Announcement
    Route::resource('master-broadcast', 'Admin\Broadcast\BroadcastController');
    Route::resource('master-group-announcement', 'Admin\GroupAnnouncement\GroupAnnouncementController');
    Route::post('master-group-announcement/upload/excel', 'Admin\GroupAnnouncement\GroupAnnouncementController@uploadExcel')->name('upload.excel.announcement');
    Route::post('master-group-announcement/import/excel', 'Admin\GroupAnnouncement\GroupAnnouncementController@importExcel')->name('import.excel.announcement');
    Route::get('master-group-announcement/manage-recipients/group/{groups_announcement_id}', 'Admin\GroupAnnouncement\GroupAnnouncementController@recipients')->name('manage-recipients.recipients');
    Route::post('master-group-announcement/manage-recipients/group/post', 'Admin\GroupAnnouncement\GroupAnnouncementController@storeRecipients')->name('manage-recipients.recipients.post');
    Route::get('master-group-announcement/manage-recipients/delete-recipients/{id}/{groups_announcement_id}', 'Admin\GroupAnnouncement\GroupAnnouncementController@destroyRecipients')->name('manage-recipients.delete');
    Route::get('master-broadcast-track/{id}/{email}', 'Admin\Broadcast\BroadcastController@detailLinkClick');

    //Sales
    Route::resource('master-product', 'Admin\Product\ProductController');
    Route::get('master-product-delete/{id}', 'Admin\Product\ProductController@deleteFile')->name('master.product.delete');
    Route::resource('master-category-of-product', 'Admin\ProductCategory\ProductCategoryController');

    //Vendor
    Route::resource('master-vendor', 'Admin\Vendor\VendorController');
    Route::get('master-vendor-delete/{id}', 'Admin\Vendor\VendorController@deleteFile')->name('master.vendor.delete');
    Route::resource('master-vendor-order', 'Admin\Vendor\VendorOrderController');
    Route::get('master-vendor-order-delete/{id}', 'Admin\Vendor\VendorOrderController@deleteFile')->name('master.vendor.order.delete');
    Route::resource('master-vendor-contact', 'Admin\Vendor\VendorContactPersonController');
    Route::resource('master-vendor-product-price', 'Admin\Vendor\VendorProductPriceController');


    //Transaction
    Route::resource('master-transaction', 'Admin\Transaction\TransactionController');

    //Trend Point
    Route::resource('trend-point', 'Admin\TrendPoint\TrendPointController');

    //Customer Tracking
    Route::resource('customer-tracking', 'Admin\CustomerTracking\CustomerTrackingController');

    //Billings Tenant
    Route::resource('master-billing', 'Admin\Billing\BillingController');

    // Manage Popup
    Route::resource('manage-popup', 'Admin\Popup\PopupController');
});
