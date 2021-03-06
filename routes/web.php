<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LaserController;
use App\Http\Controllers\CustomerInvoiceController;
use App\Http\Controllers\VendorInvoiceController;

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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('user-login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::get('/types', [TypeController::class, 'index'])->name('types');
Route::get('/read-types', [TypeController::class, 'readTypes'])->name('read-invoice-types');
Route::post('/types', [TypeController::class, 'store'])->name('create-type');
Route::get('/get-single-types/{id}', [TypeController::class, 'getSingleType'])->name('get-single-type');
Route::post('/update-type', [TypeController::class, 'updateType'])->name('update-type');
Route::post('/delete-type', [TypeController::class, 'deleteType'])->name('delete-type');

Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
Route::get('/read-customers', [CustomerController::class, 'readCustomers'])->name('read-customers');
Route::get('/customers/{id}', [CustomerController::class, 'getSingleCustomer'])->name('single-customer');
Route::post('/customers', [CustomerController::class, 'store'])->name('create-customer');
Route::get('/single-customer/{id}', [CustomerController::class, 'getCustomerToUpdate'])->name('get-single-customer-to-update');
Route::post('/update-customer', [CustomerController::class, 'updateCustomer'])->name('update-customer');
Route::post('/delete-customer', [CustomerController::class, 'deleteCustomer'])->name('delete-customer');

Route::get('/our-vendors', [VendorController::class, 'index'])->name('vendors');
Route::get('/our-vendors/{id}', [VendorController::class, 'getSingleVendor'])->name('single-vendor');
Route::post('/create-vendor', [VendorController::class, 'store'])->name('create-vendor');
Route::get('/read-vendors', [VendorController::class, 'readVendors'])->name('read-vendor');
Route::get('/single-vendor/{id}', [VendorController::class, 'getVendorToUpdate'])->name('get-single-vendor-to-update');
Route::post('/update-vendor', [VendorController::class, 'updateVendor'])->name('update-vendor');
Route::post('/delete-vendor', [VendorController::class, 'deleteVendor'])->name('delete-vendor');

Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices');
Route::get('/read-invoices', [InvoiceController::class, 'readInvoices'])->name('read-invoice');
Route::post('/invoices', [InvoiceController::class, 'storeInvoice'])->name('create-invoice');
Route::get('/get-last-invoice-doc-no', [InvoiceController::class, 'getLastInvoiceDocNo'])->name('get-last-invoice-doc-no');

Route::get('/read-single-customer-invoice/{id}', [CustomerInvoiceController::class, 'readCustomerInvoices'])->name('read-customer-invoice');
Route::post('/get-customer-single-invoice-data', [CustomerInvoiceController::class, 'getSingleInvoiceData'])->name('get-customer-single-invoice-data');
Route::post('/update-customer-invoice', [CustomerInvoiceController::class, 'updateCustomerInvoice'])->name('update-customer-invoice');
Route::post('/delete-customer-invoice', [CustomerInvoiceController::class, 'deleteCustomerInvoice'])->name('delete-customer-invoice');
Route::post('/void-customer-invoice', [CustomerInvoiceController::class, 'voidCustomerInvoice'])->name('void-customer-invoice');

Route::get('/read-single-vendor-invoice/{id}', [VendorInvoiceController::class, 'readVendorInvoices'])->name('read-vendor-invoice');
Route::post('/get-vendor-single-invoice-data', [VendorInvoiceController::class, 'getSingleInvoiceData'])->name('get-vendor-single-invoice-data');
Route::post('/update-vendor-invoice', [VendorInvoiceController::class, 'updateVendorInvoice'])->name('update-vendor-invoice');
Route::post('/delete-vendor-invoice', [VendorInvoiceController::class, 'deleteVendorInvoice'])->name('delete-vendor-invoice');
Route::post('/void-vendor-invoice', [VendorInvoiceController::class, 'voidVendorInvoice'])->name('void-vendor-invoice');

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::post('/users', [UserController::class, 'createUser'])->name('create-user');
Route::get('/read-users', [UserController::class, 'readUser'])->name('read-users');
Route::post('/delete-user', [UserController::class, 'deleteUser'])->name('delete-user');
Route::get('/setting', [UserController::class, 'showSetting'])->name('setting');
Route::get('/get-user-data', [UserController::class, 'getUserData'])->name('get-user-data');

Route::post('/generate-laser', [LaserController::class, 'generateLaser'])->name('generate-laser');