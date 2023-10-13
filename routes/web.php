<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
//use App\Http\Controllers\ForgetPasswordController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::post("/signin", [UserController::class, "gohome"])->name("signin");
Route::post("/register", [UserController::class, "register"])->name("register");
Route::get("logout", [UserController::class, "logout"])->name("logout");

Route::get("/", [UserController::class, "home"])->name("home");

Route::get('/login', function(){
    return view('login');
});



Route::get('/signup', function(){
    return view('signup');
});


Route::get("provserv", [UserController::class, "provserv"])->name("provserv")->middleware('isLoggedIn');
Route::get("account-page", [UserController::class, "provacc"])->name("account-page")->middleware('isLoggedIn');
Route::get("edit-profile-page", [UserController::class, "ProvEditP"])->name("edit-profile-page")->middleware('isLoggedIn');
Route::post('/updatepage/{id}', [UserController::class, 'updateProvProfile'])->name('updatepage')->middleware('isLoggedIn');
Route::get("view-customer-account-page/{id}", [UserController::class, "viewcusvacc"])->name("view-customer-account-page")->middleware('isLoggedIn');
Route::get("unavailable/{id}", [UserController::class, "setUnavailableService"])->name("unavailable")->middleware('isLoggedIn');
Route::get("available/{id}", [UserController::class, "setAvailableService"])->name("available")->middleware('isLoggedIn');
Route::get("delete/{id}", [UserController::class, "deleteAService"])->name("delete")->middleware('isLoggedIn');
Route::get("service-name", [UserController::class, "changeServiceNameView"])->name("service-name")->middleware('isLoggedIn');
Route::post('/updatesn/{id}', [UserController::class, 'updateServiceName'])->name('updatesn')->middleware('isLoggedIn');
Route::get('/update-service/{id}', [UserController::class, 'editServiceView'])->name('update-service')->middleware('isLoggedIn');
Route::post('/service-updated/{id}', [UserController::class, 'updateService'])->name('service-updated')->middleware('isLoggedIn');
Route::get("p-bookings", [UserController::class, "viewAllbookingrequests"])->name("p-bookings")->middleware('isLoggedIn');
Route::get("accepted/{id}", [UserController::class, "acceptBookedService"])->name("accepted")->middleware('isLoggedIn');
Route::get("decline/{id}", [UserController::class, "declineBookedService"])->name("decline")->middleware('isLoggedIn');
Route::get("fulfill/{id}", [UserController::class, "FulfillBookedService"])->name("fulfill")->middleware('isLoggedIn');
Route::get("paid/{id}", [UserController::class, "paidBooking"])->name("paid")->middleware('isLoggedIn');
Route::get("npaid/{id}", [UserController::class, "notpaidBooking"])->name("npaid")->middleware('isLoggedIn');
Route::get('/pChangepw', [UserController::class, 'pChangepw'])->name('pChangepw')->middleware('isLoggedIn');
Route::post('/updatePassword/{id}', [UserController::class, 'updatePassword'])->name('updatePassword')->middleware('isLoggedIn');
Route::get('/add-service', [UserController::class, 'startServiceVIEW'])->name('add-service')->middleware('isLoggedIn');
Route::post('/makeService', [UserController::class, 'makeService'])->name('makeService')->middleware('isLoggedIn');
Route::post('/review-customer/{id}', [UserController::class, 'addCrev'])->name('review-customer')->middleware('isLoggedIn');




//CUSTOMER
Route::get("Home", [UserController::class, "cHome"])->name("customer-home");
Route::get("customer-account-page", [UserController::class, "custacc"])->name("customer-account-page")->middleware('isLoggedIn');
Route::post('/update-page/{id}', [UserController::class, 'updateCusProfile'])->name('update-page')->middleware('isLoggedIn');
Route::get("book-service/{id}", [UserController::class, "makebooking"])->name("book-service")->middleware('isLoggedIn');
Route::get("bookings", [UserController::class, "viewbooking"])->name("bookings")->middleware('isLoggedIn');
Route::get("view-provider-account-page/{id}", [UserController::class, "viewprovacc"])->name("view-provider-account-page")->middleware('isLoggedIn');
Route::get("services", [UserController::class, "displayServices"])->name("services");
Route::get("edit-profile-customer", [UserController::class, "CustEditP"])->name("edit-profile-customer")->middleware('isLoggedIn');
Route::get('/cChangepw', [UserController::class, 'cChangepw'])->name('cChangepw')->middleware('isLoggedIn');
//Route::get('/review-provider', [UserController::class, 'reviewProvider'])->name('review-provider')->middleware('isLoggedIn');
Route::get("cancel/{id}", [UserController::class, "cancelBookedService"])->name("cancel")->middleware('isLoggedIn');

Route::post('/update-Password/{id}', [UserController::class, 'updatePassword'])->name('update-Password')->middleware('isLoggedIn');
Route::post('/booking-requested/{id}', [UserController::class, 'bookservice'])->name('booking-requested')->middleware('isLoggedIn');
//Route::post('/review-provider/{id}', [UserController::class, 'addPrev'])->name('review-customer');
Route::post('/add-refno/{id}', [UserController::class, 'CustconfirmPayment'])->name('add-refno')->middleware('isLoggedIn');


//forget password
Route::get('/forget-password', [ForgetPasswordController::class, 'viewForgetPassword'])->name('forget-password');
//Route::post('/forgetpassword', [ForgetPasswordController::class, 'forgetPassword'])->name('forgetpassword');
Route::get('/reset-password/{token}', [ForgetPasswordController::class, 'reset'])->name('reset-password');
//Route::post('/resetpassword', [ForgetPasswordController::class, 'resetPassword'])->name('resetpassword');
