<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/testdb', function () {
    return view('testDb');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/home/users', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('admin.users');
// Route::get('/home/users/edit/', [App\Http\Controllers\Admin\UsersController::class, 'edit'])->name('admin.users.edit');
Route::get('/home/reports', [App\Http\Controllers\HomeController::class, 'reports'])->name('admin.reports');
Route::get('/home/reports/scene', [App\Http\Controllers\HomeController::class, 'reportScene'])->name('admin.reports-scenes');

Route::get('/home/logs/logins', [App\Http\Controllers\LogController::class, 'getLoginHistogram'])->name('admin.logs.logins');
Route::get('/home/logs/registers', [App\Http\Controllers\LogController::class, 'getRegisterHistogram'])->name('admin.logs.registers');
Route::get('/home/logs/validatedRegisters', [App\Http\Controllers\LogController::class, 'getValidatedRegisterHistogram'])->name('admin.logs.validated-registers');
Route::get('/home/logs/getUsersinLogs', [App\Http\Controllers\LogController::class, 'getUsersInLogs'])->name('admin.logs.getUsersInLogs');
Route::get('/home/logs/getUserLogs', [App\Http\Controllers\LogController::class, 'getUserLogs'])->name('admin.logs.getUserLogs');
Route::get('/home/logs/getRegisteredUsers', [App\Http\Controllers\LogController::class, 'getRegisteredUsers'])->name('admin.logs.getRegisteredUsers');

//register
Route::get('/emailForm/{companyId}', [App\Http\Controllers\RegisterFormController::class, 'emailForm'])->name('email-form');
Route::get('/registerForm/{companyId}', [App\Http\Controllers\RegisterFormController::class, 'registerForm'])->name('register-form');
Route::get('/registerFormDirect', [App\Http\Controllers\RegisterFormController::class, 'registerFormDirect'])->name('register-form-direct');
Route::get('/registerFormDirectISEM', [App\Http\Controllers\RegisterFormController::class, 'registerFormDirectISEM'])->name('register-form-direct-isem');
Route::post('/directRegisterValidateForm', [App\Http\Controllers\RegisterFormController::class, 'validateDirectRegister'])->name('register-validate-form-direct');
Route::post('/directRegisterValidateFormISEM', [App\Http\Controllers\RegisterFormController::class, 'validateDirectRegisterISEM'])->name('register-validate-form-direct-isem');
Route::post('/registerValidateForm', [App\Http\Controllers\RegisterFormController::class, 'registerValidateForm'])->name('register-validate-form');
Route::post('/validateCode', [App\Http\Controllers\RegisterFormController::class, 'validateCode'])->name('validate-code');
Route::post('/logincustom', [App\Http\Controllers\RegisterFormController::class, 'customLogin'])->name('custom-login');

//pre register form 
Route::get('/createRequest', [App\Http\Controllers\RegisterFormController::class, 'preRegister'])->name('preRegister');
Route::post('/createRequest/store', [App\Http\Controllers\RegisterFormController::class, 'preRegisterStore'])->name('preRegister-store');

Route::get('/home/users/getall', [App\Http\Controllers\Admin\UsersController::class, 'getall'])->name('admin.users.getall');
Route::get('/home/users/block', [App\Http\Controllers\Admin\UsersController::class, 'block'])->name('admin.users.block');
Route::resource('/home/users',App\Http\Controllers\Admin\UsersController::class)->names('admin.users');

Route::get('/home/configurations/profile', [App\Http\Controllers\ConfigController::class, 'profileConfigurations'])->name('admin.configurations.profile');
Route::post('/home/configuration/profile/update', [App\Http\Controllers\ConfigController::class, 'update'])->name('admin.config.update');
Route::post('/home/configuration/profile/update-password', [App\Http\Controllers\ConfigController::class, 'updatePassword'])->name('admin.config.update-password');
Route::get('/home/configurations/profile/update-company-user', [App\Http\Controllers\ConfigController::class, 'updateCompanyUser'])->name('admin.configurations.update-company-user');
Route::get('/home/configurations/profile/change-password', [App\Http\Controllers\ConfigController::class, 'changePassword'])->name('admin.configurations.change-password');
Route::get('/home/configurations/company', [App\Http\Controllers\ConfigController::class, 'companyConfigurations'])->name('admin.configurations.company');
Route::get('/home/configurations/company/edit', [App\Http\Controllers\ConfigController::class, 'companyConfigurationsEdit'])->name('admin.configurations.company-edit');
Route::post('/home/configurations/company/update', [App\Http\Controllers\ConfigController::class, 'companyConfigurationsUpdate'])->name('admin.configurations.company-update');
Route::get('/home/configurations/scenes', [App\Http\Controllers\ConfigController::class, 'scenesConfigurations'])->name('admin.configurations.scenes');
Route::get('/home/configurations/scenes/edit', [App\Http\Controllers\ConfigController::class, 'scenesConfigurationsEdit'])->name('admin.configurations.scenes-edit');
Route::post('/home/configurations/scenes/update', [App\Http\Controllers\ConfigController::class, 'scenesConfigurationsUpdate'])->name('admin.configurations.scenes-update');

Route::get('/home/companies/getall', [App\Http\Controllers\CompaniesController::class, 'getall'])->name('admin.companies.getall');
Route::get('/home/companies/deployments', [App\Http\Controllers\CompaniesController::class, 'deployments'])->name('admin.companies.deployments');
Route::get('/home/companies/deployments/create', [App\Http\Controllers\CompaniesController::class, 'deploymentCreate'])->name('admin.companies.deploymentCreate');
Route::get('/home/companies/deployments/setAvailable', [App\Http\Controllers\CompaniesController::class, 'setAvailable'])->name('admin.companies.setAvailable');
Route::resource('/home/companies',App\Http\Controllers\CompaniesController::class)->names('admin.companies');
