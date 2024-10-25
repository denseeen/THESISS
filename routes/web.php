<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FormController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\SecurityQuestionController;
use App\Http\Controllers\DarkModeController;

use App\Http\Controllers\InstallmentProcessController;

use App\Http\Controllers\AdminFetchingController;
use App\Http\Controllers\CustomerFetchingController;
use App\Http\Controllers\AdminDashboardController;


use App\Http\Controllers\NotificationController;


// Route::get('/welcome',[AuthManager::class, 'Def'])->name('welcome'); 

Route::get('/', function () {
    return redirect()->route('about.layout');
});

//old design
// Route::get('/customer',[AuthManager::class, 'customerUI'])->name('about.customer'); 
// Route::get('/customer', [AuthManager::class, 'customerUI'])->middleware('auth')->name('about.customer'); 

//old design
// Route::get('/admin',[AuthManager::class, 'adminUI'])->name('about.admin');

//old login
// Route::get('/logins',[AuthManager::class, 'Login'])->name('about.login'); 
Route::post('/adduser',[AuthManager::class, 'Saved'])->name('about.save'); 


//Welcome page
Route::get('/Main', [AuthManager::class, 'home'])->name('about.layout');

//Online Application
Route::get('/register',[AuthManager::class, 'Resgistration'])->name('about.registration');

// Route for saving user creating account
Route::post('/logins',[FormController::class, 'LoginEntry'])->name('about.entry'); 


// ADMIN
Route::get('/admin/profile',[AuthManager::class, 'admin_profile'])->name('adprofile.show');
Route::get('/admin/installment',[AuthManager::class, 'admin_installment'])->name('adinstallment.show');
Route::get('/admin/fullypaid',[AuthManager::class, 'admin_fullypaid'])->name('adfullypaid.show');
Route::get('/admin/dashboard',[AuthManager::class, 'admin_dashboard'])->name('addashboard.show');
Route::get('/admin/archived',[AuthManager::class, 'admin_archived'])->name('adarchived.show');
Route::get('/admin/request',[AuthManager::class, 'admin_request'])->name('adrequest.show');
Route::get('/admin/edit',[AuthManager::class, 'admin_edit'])->name('edit.show');

// customer infomation Edit
Route::get('/search-customer', [AdminDashboardController::class, 'searchCustomer']); //search function for both cusInfo_intallProcess
Route::get('/edit-customer/{id}', [AdminDashboardController::class, 'showEditForm']);
Route::post('/update-customer', [AdminDashboardController::class, 'updateCustomer']);

// customer intallment_process edit
Route::get('/get-installments/{customerId}', [AdminDashboardController::class, 'getInstallments']);
Route::get('/get-installment/{installmentId}', [AdminDashboardController::class, 'getInstallment']);
Route::post('/update-installment/{installmentId}', [AdminDashboardController::class, 'updateInstallment']);


// REGISTRATION
Route::post('/submit-form', [FormController::class, 'submitForm'])->name('form.submit');
Route::get('/success', function () {
    return view('about.success'); // This should be the view you want to show after successful submission
})->name('success.page');


// CUSTOMER
// Route::get('/customer/profile',[AuthManager::class, 'customer_profile'])->name('cusprofile.show');
Route::get('/customer/perchasehistory',[AuthManager::class, 'customer_perchasehistory'])->name('cuspurchasehistory.show');
Route::get('/customer/dashboard',[AuthManager::class, 'customer_dashboard'])->name('cusdasboard.show');

// customer_order/dashboard
Route::get('/api/unit-details', [CustomerFetchingController::class, 'getUnitDetails']);
// In web.php or api.php
Route::get('/api/account-number', [CustomerFetchingController::class, 'getAccountNumber']);

// customer payment_schedule
Route::get('/payment-schedule/customer', [CustomerFetchingController::class, 'getBillingInfoAndPaymentSchedule'])->middleware('auth');
// customer transaction
Route::get('/billing-history', [CustomerFetchingController::class, 'getBillingHistory'])->name('billing.history');


// Route to save the upload avatar
Route::middleware('auth')->group(function () {
    Route::post('/upload-avatar', [AuthManager::class, 'upload'])->name('upload-avatar');
    Route::post('/upload-avatar-admin', [AuthManager::class, 'upload'])->name('upload-avatar-admin');
});


//display information from customer_info
    Route::get('/customer/profile',[DisplayController::class, 'user_infos'])->name('cusprofile.show');

//display information from customer_admin
    Route::get('/admin/profile',[DisplayController::class, 'user_infos_admin'])->name('adprofile.show');

// changepassword
Route::post('/change-password', [AuthManager::class, 'changePassword'])->name('password.change');

//customer setting questions
Route::get('/customer/security',[SecurityQuestionController::class, 'customer_security'])->name('cussecurity.show');
Route::post('/customer/security', [SecurityQuestionController::class, 'store'])->name('cussecurity.store');

//admin setting questions
Route::get('/admin/security',[SecurityQuestionController::class, 'admin_security'])->name('adsecurity.show');
Route::post('/admin/security', [SecurityQuestionController::class, 'store'])->name('adsecurity.store');

// Route to show the forgot password form
Route::get('/forgotpassword', [SecurityQuestionController::class, 'forgotpassword'])->name('forgotpassword.show');
// Route to get the security question based on the email
Route::post('/get-security-question', [SecurityQuestionController::class, 'getSecurityQuestion'])->name('security.question');
// Route to validate the security question answer
Route::post('/validate-answer', [SecurityQuestionController::class, 'validateAnswer'])->name('validate.answer');
// Route to handle password update
Route::post('/update-password', [SecurityQuestionController::class, 'updatePassword'])->name('update.password');
//Route for succesfully changing
Route::get('/success-forgotpassword',[SecurityQuestionController::class, 'changeforgotpassword'])->name('changeforgotpassword.show');


//Route for DarkMode
Route::post('/update-dark-mode', [DarkModeController::class, 'updateDarkMode'])->name('update-dark-mode');


Route::get('/admin/installment', [AdminFetchingController::class, 'InstallmentCustomer'])->name('Installment_Customer.show');
Route::get('/admin/fullypaid', [AdminFetchingController::class, 'FullyPaidCustomer'])->name('FullyPaid_Customer.show');

// Route to fetch customer details by ID
Route::get('/customer/{id}', [AdminFetchingController::class, 'getCustomer']);
Route::get('/payment-schedule/{customerId}', [AdminFetchingController::class, 'getPaymentSchedule']);
// In routes/api.php or routes/web.php
Route::get('/fully-paid-customers', [AdminFetchingController::class, 'getFullyPaidCustomers']);


// Route for storing new installment_process data
Route::post('/installment/store', [AdminFetchingController::class, 'store'])->name('installment.store');
Route::post('/installment/archive', [AdminFetchingController::class, 'archive'])->name('installment.archive');
Route::get('/admin/archived', [AdminFetchingController::class, 'showArchived'])->name('installments.archived');
// Route::delete('/customer/{id}', [AdminFetchingController::class, 'deleteCustomer'])->name('customer.delete');
Route::delete('/customer/{id}', [AdminFetchingController::class, 'destroy'])->name('customer.destroy');
Route::post('/add-order', [AdminFetchingController::class, 'addOrder'])->name('add.order');



// Route to fetch customer details by ID, modal in installment
Route::get('/customer/{id}', [DisplayController::class, 'getCustomer']);

// admin customer List -dashboard
Route::get('/api/customers', [DisplayController::class, 'getCustomers']);


// Route::post('/installment/archive/{id}', [AdminFetchingController::class, 'archive'])->name('installment.archive');
// Route::get('/admin/archived', [AdminFetchingController::class, 'showArchived'])->name('installments.archived');
//Route for dashboard customer list
// Route::get('/admin/dashboard',[DisplayController::class, 'admin_dashboard'])->name('addashboard.show');
//Route for installment customer list
// Route::get('/admin/installment',[DisplayController::class, 'cusInstallments'])->name('adinstallment.show');
//Route for fullypaid customer list
// Route::get('/admin/fullypaid',[DisplayController::class, 'cusfullypaid'])->name('adfullypaid.show');
// Route::get('/payment-schedule/{customerId}', [DisplayController::class, 'getPaymentSchedule']);
// Fetching the Information in customer_info database
// Route::get('/admin/dashboard', [AdminFetchingController::class, 'AdminDashboardCustomerList'])->name('admin_dashboard.show');


//Route for notification
Route::post('/send-message', [NotificationController::class, 'sendMessage'])->middleware('auth');
// Route to fetch unread notifications for the user/customer-dashboard
Route::get('/api/messages', [NotificationController::class, 'fetchMessages']);
// Route for marking a message as read, delete/customer-dashboard
Route::delete('/api/messages/{id}', [NotificationController::class, 'deleteMessage']);


// dashboard cards
Route::get('/api/expected-income', [AdminFetchingController::class, 'getExpectedIncome']);
Route::get('/api/payment-received', [AdminFetchingController::class, 'getPaymentReceived']);
Route::get('/api/installment-count', [AdminFetchingController::class, 'getInstallmentCount']);
Route::get('/api/fully-paid-count', [AdminFetchingController::class, 'getFullyPaidCount']);
Route::get('/api/sales-unit-count', [AdminFetchingController::class, 'getSalesUnitCount']);