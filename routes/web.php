<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\FormController;

// Route::get('/welcome',[AuthManager::class, 'Def'])->name('welcome'); 

Route::get('/', function () {
    return redirect()->route('about.layout');
});

Route::get('/Main', [AuthManager::class, 'home'])->name('about.layout');


Route::get('/register',[AuthManager::class, 'Resgistration'])->name('about.registration'); 


Route::post('/adduser',[AuthManager::class, 'Saved'])->name('about.save'); 

Route::get('/logins',[AuthManager::class, 'Login'])->name('about.login'); 

Route::post('/logins',[AuthManager::class, 'LoginEntry'])->name('about.entry'); 



// Route::get('/customer',[AuthManager::class, 'customerUI'])->name('about.customer'); 


Route::get('/customer', [AuthManager::class, 'customerUI'])->middleware('auth')->name('about.customer');
Route::get('/users', [YourController::class, 'index']);





Route::get('/admin',[AuthManager::class, 'adminUI'])->name('about.admin');

// ADMIN
Route::get('/adminprofile',[AuthManager::class, 'admin_profile'])->name('adprofile.show');
Route::get('/admininstallment',[AuthManager::class, 'admin_installment'])->name('adinstallment.show');
Route::get('/adminfullypaid',[AuthManager::class, 'admin_fullypaid'])->name('adfullypaid.show');
Route::get('/admindashboard',[AuthManager::class, 'admin_dashboard'])->name('addashboard.show');
Route::get('/adminarchived',[AuthManager::class, 'admin_archived'])->name('adarchived.show');
Route::get('/adminrequest',[AuthManager::class, 'admin_request'])->name('adrequest.show');

// CUSTOMER
Route::get('/cusprofile',[AuthManager::class, 'customer_profile'])->name('cusprofile.show');
Route::get('/cusperchasehistory',[AuthManager::class, 'customer_perchasehistory'])->name('cuspurchasehistory.show');
Route::get('/cusdashboard',[AuthManager::class, 'customer_dashboard'])->name('cusdasboard.show');

// REGISTRATION
Route::post('/submit-form', [FormController::class, 'submitForm'])->name('form.submit');
Route::get('/success', function () {
    return view('about.success'); // This should be the view you want to show after successful submission
})->name('success.page');