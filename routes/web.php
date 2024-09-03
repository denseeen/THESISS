<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomerListController;
use App\Http\Controllers\FormController;

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

// changepassword
Route::post('/change-password', [AuthManager::class, 'changePassword'])->name('password.change');

Route::get('/admin',[AuthManager::class, 'adminUI'])->name('about.admin');

// ADMIN
Route::get('/admin/profile',[AuthManager::class, 'admin_profile'])->name('adprofile.show');
Route::get('/admin/installment',[AuthManager::class, 'admin_installment'])->name('adinstallment.show');
Route::get('/admin/fullypaid',[AuthManager::class, 'admin_fullypaid'])->name('adfullypaid.show');
Route::get('/admin/dashboard',[AuthManager::class, 'admin_dashboard'])->name('addashboard.show');
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




























