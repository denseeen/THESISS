<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use Illuminate\Support\Facades\Auth;

Route::get('/welcome',[AuthManager::class, 'Def'])->name('welcome'); 

Route::get('/Main',[AuthManager::class, 'home'])->name('about.layout');


Route::get('/register',[AuthManager::class, 'Resgistration'])->name('about.registration'); 


Route::post('/adduser',[AuthManager::class, 'Saved'])->name('about.save'); 

Route::get('/logins',[AuthManager::class, 'Login'])->name('about.login'); 

Route::post('/logins',[AuthManager::class, 'LoginEntry'])->name('about.entry'); 

Route::get('/customer',[AuthManager::class, 'customerUI'])->name('about.customer'); 

Route::get('/admin',[AuthManager::class, 'adminUI'])->name('about.admin');


Route::get('/adminprofile',[AuthManager::class, 'admin_profile'])->name('adprofile.show');
Route::get('/admininstallment',[AuthManager::class, 'admin_installment'])->name('adinstallment.show');
Route::get('/adminfullypaid',[AuthManager::class, 'admin_fullypaid'])->name('adfullypaid.show');
Route::get('/admindashboard',[AuthManager::class, 'admin_dashboard'])->name('addashboard.show');
Route::get('/adminarchived',[AuthManager::class, 'admin_archived'])->name('adarchived.show');
Route::get('/adminrequest',[AuthManager::class, 'admin_request'])->name('adrequest.show');

Route::get('/cusprofile',[AuthManager::class, 'customer_profile'])->name('cusprofile.show');
Route::get('/cusperchasehistory',[AuthManager::class, 'customer_perchasehistory'])->name('cuspurchasehistory.show');
Route::get('/cusdashboard',[AuthManager::class, 'customer_dashboard'])->name('cusdasboard.show');





