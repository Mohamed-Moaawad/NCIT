<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\EmailController;


/// auth
Auth::routes();
Route::post('/login', [LoginController::class, 'login'])->middleware('checkstatus');
//clear
Route::get('/clear-cache', function () {

    Artisan::call('cache:clear');

    return "Cache is cleared";
});
//lang
Route::get('locale/{locale}', function ($locale) {
    App::setlocale($locale);
    // Session::put('locale', $locale);
    session(['locale' => $locale]);
    return redirect()->back();
})->name('admins.lang');
// Home
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('index');
// setting
Route::get('/setting', [SettingController::class, 'setting'])->name('admin.setting');
Route::post('/settingUpdate', [SettingController::class, 'updateSetting'])->name('admin.setting.update');
// change password
Route::get('/changePassword', [HomeController::class, 'changePassword'])->name('admin.changePassword');
Route::post('/changePass', [HomeController::class, 'changePass'])->name('admin.changePass');
// setting user
Route::get('/usersetting', [HomeController::class, 'user_setting'])->name('admin.usersetting');
Route::post('/usersettingUpdate', [HomeController::class, 'user_updateSetting'])->name('admin.usersetting.update');
//pdf
Route::get('/pdf/{id}', [InvoiceController::class, 'pdf'])->name('pdf');
Route::get('/pdf_all/', [InvoiceController::class, 'pdf_all'])->name('pdf_all');
//send email
Route::get('/send_pdf/{id}', [InvoiceController::class, 'send_pdf'])->name('send_pdf');
// restore
Route::get('restore/User',function(){
    \App\Models\User::onlyTrashed()->restore();
})->name('users.restore');

Route::get('restore/Item',function(){
    \App\Models\Item::where('user_id', Auth::user()->id)->withTrashed()->restore();
})->name('items.restore');;

Route::get('restore/invoice',function(){
    \App\Models\Invoice::where('user_id', Auth::user()->id)->withTrashed()->restore();
})->name('invoices.restore');;

Route::get('restore/clients',function(){
    \App\Models\Client::where('user_id', Auth::user()->id)->withTrashed()->restore();
})->name('clients.restore');;

// client rep
Route::get('/rep', [InvoiceController::class, 'rep'])->name('rep');
// reminder
Route::get('/reminder/{id}', [InvoiceController::class, 'reminder'])->name('reminder');
Route::get('/reminder_cancel/{id}', [InvoiceController::class, 'reminder_cancel'])->name('reminder_cancel');
/////
Route::get('/pdf_rep/{id}', [InvoiceController::class, 'pdf_Rep'])->name('pdf_Rep');
//
Route::get('/pdf_Rep_date/{id}/{from?}/{to?}', [InvoiceController::class, 'pdf_Rep_date'])->name('pdf_Rep_date');
////////////////////////////////////////////////
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('items', ItemController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('invoices', InvoiceController::class);
});
/////////////////////////////send email/////////////////////////////////////////////////
Route::get('viewInvoice/{id}/{hash}',[EmailController::class, 'pdf'])->name('send_Email');
















