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


// Route::get('/welcome',[AuthManager::class, 'Def'])->name('welcome'); 

Route::get('/', function () {
    return redirect()->route('about.layout');
});

Route::get('/Main', [AuthManager::class, 'home'])->name('about.layout');

Route::get('/register',[AuthManager::class, 'Resgistration'])->name('about.registration'); 

Route::get('/logins',[AuthManager::class, 'Login'])->name('about.login'); 

Route::post('/logins',[FormController::class, 'LoginEntry'])->name('about.entry'); 

Route::get('/customer',[AuthManager::class, 'customerUI'])->name('about.customer'); 

// Route::get('/customer', [AuthManager::class, 'customerUI'])->middleware('auth')->name('about.customer'); 



// Route for saving user creating account
Route::post('/adduser',[AuthManager::class, 'Saved'])->name('about.save'); 


Route::get('/admin',[AuthManager::class, 'adminUI'])->name('about.admin');

// ADMIN
Route::get('/admin/profile',[AuthManager::class, 'admin_profile'])->name('adprofile.show');
Route::get('/admin/installment',[AuthManager::class, 'admin_installment'])->name('adinstallment.show');
Route::get('/admin/fullypaid',[AuthManager::class, 'admin_fullypaid'])->name('adfullypaid.show');
// Route::get('/admin/dashboard',[AuthManager::class, 'admin_dashboard'])->name('addashboard.show');
Route::get('/admin/archived',[AuthManager::class, 'admin_archived'])->name('adarchived.show');
Route::get('/admin/request',[AuthManager::class, 'admin_request'])->name('adrequest.show');

// CUSTOMER
Route::get('/customer/profile',[AuthManager::class, 'customer_profile'])->name('cusprofile.show');
Route::get('/customer/perchasehistory',[AuthManager::class, 'customer_perchasehistory'])->name('cuspurchasehistory.show');
Route::get('/customer/dashboard',[AuthManager::class, 'customer_dashboard'])->name('cusdasboard.show');


// REGISTRATION
Route::post('/submit-form', [FormController::class, 'submitForm'])->name('form.submit');
Route::get('/success', function () {
    return view('about.success'); // This should be the view you want to show after successful submission
})->name('success.page');


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

// Fetching the Information in customer_info database
Route::get('/admin/dashboard', [AdminFetchingController::class, 'AdminDashboardCustomerList'])->name('admin_dashboard.show');

Route::get('/admin/installment', [AdminFetchingController::class, 'InstallmentCustomer'])->name('Installment_Customer.show');
Route::get('/admin/fullypaid', [AdminFetchingController::class, 'FullyPaidCustomer'])->name('FullyPaid_Customer.show');
// Route to fetch customer details by ID
Route::get('/customer/{id}', [AdminFetchingController::class, 'getCustomer']);
Route::get('/payment-schedule/{customerId}', [AdminFetchingController::class, 'getPaymentSchedule']);


// Route for storing new installment_process data
Route::post('/installment/store', [AdminFetchingController::class, 'store'])->name('installment.store');


































