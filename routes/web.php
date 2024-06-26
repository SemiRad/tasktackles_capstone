<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DeniedUserController;

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


Route::get("provserv", [UserController::class, "provserv"])->name("provserv")->middleware('isProvider');
Route::get("account-page", [UserController::class, "provacc"])->name("account-page")->middleware('isProvider');
Route::get("edit-profile-page", [UserController::class, "ProvEditP"])->name("edit-profile-page")->middleware('isProvider');
Route::post('/updatepage/{id}', [UserController::class, 'updateProvProfile'])->name('updatepage')->middleware('isProvider');
Route::get("view-customer-account-page/{id}", [UserController::class, "viewcusvacc"])->name("view-customer-account-page")->middleware('isProvider');
Route::get("unavailable/{id}", [UserController::class, "setUnavailableService"])->name("unavailable")->middleware('isProvider');
Route::get("available/{id}", [UserController::class, "setAvailableService"])->name("available")->middleware('isProvider');
Route::get("delete/{id}", [UserController::class, "deleteAService"])->name("delete")->middleware('isProvider');
Route::get("service-name", [UserController::class, "changeServiceNameView"])->name("service-name")->middleware('isProvider');
Route::post('/updatesn/{id}', [UserController::class, 'updateServiceName'])->name('updatesn')->middleware('isProvider');
Route::get('/update-service/{id}', [UserController::class, 'editServiceView'])->name('update-service')->middleware('isProvider');
Route::post('/service-updated/{id}', [UserController::class, 'updateService'])->name('service-updated')->middleware('isProvider');
Route::get("p-bookings", [UserController::class, "viewAllbookingrequests"])->name("p-bookings")->middleware('isProvider');
Route::get("accepted/{id}", [UserController::class, "acceptBookedService"])->name("accepted")->middleware('isProvider');
Route::get("decline/{id}", [UserController::class, "declineBookedService"])->name("decline")->middleware('isProvider');
Route::get("fulfill/{id}", [UserController::class, "FulfillBookedService"])->name("fulfill")->middleware('isProvider');
Route::get("paid/{id}", [UserController::class, "paidBooking"])->name("paid")->middleware('isProvider');
Route::get("npaid/{id}", [UserController::class, "notpaidBooking"])->name("npaid")->middleware('isProvider');
Route::get('/pChangepw', [UserController::class, 'pChangepw'])->name('pChangepw')->middleware('isProvider');
Route::post('/updatePassword/{id}', [UserController::class, 'updatePassword'])->name('updatePassword')->middleware('isProvider');
Route::get('/add-service', [UserController::class, 'startServiceVIEW'])->name('add-service')->middleware('isProvider');;
Route::post('/makeService', [UserController::class, 'makeService'])->name('makeService')->middleware('isProvider');
Route::post('/review-customer/{id}', [UserController::class, 'addCrev'])->name('review-customer')->middleware('isProvider');




//CUSTOMER
Route::get("customer-home", [UserController::class, "cHome"])->name("customer-home")->middleware('isCustomer');
Route::get("customer-account-page", [UserController::class, "custacc"])->name("customer-account-page")->middleware('isCustomer');
Route::post('/update-page/{id}', [UserController::class, 'updateCusProfile'])->name('update-page')->middleware('isCustomer');
Route::get("book-service/{id}", [UserController::class, "makebooking"])->name("book-service")->middleware('isCustomer');
Route::get("bookings", [UserController::class, "viewbooking"])->name("bookings")->middleware('isCustomer');
Route::get("view-provider-account-page/{id}", [UserController::class, "viewprovacc"])->name("view-provider-account-page");
Route::get("services", [UserController::class, "displayServices"])->name("services");
Route::get("edit-profile-customer", [UserController::class, "CustEditP"])->name("edit-profile-customer")->middleware('isCustomer');
Route::get('/cChangepw', [UserController::class, 'cChangepw'])->name('cChangepw')->middleware('isCustomer');
//Route::get('/review-provider', [UserController::class, 'reviewProvider'])->name('review-provider')->middleware('isCustomer');
Route::get("cancel/{id}", [UserController::class, "cancelBookedService"])->name("cancel")->middleware('isCustomer');

Route::post('/update-Password/{id}', [UserController::class, 'updatePassword'])->name('update-Password')->middleware('isCustomer');
Route::post('/booking-requested/{id}', [UserController::class, 'bookservice'])->name('booking-requested')->middleware('isCustomer');
Route::post('/review-provider/{id}', [UserController::class, 'addPrev'])->name('review-provider')->middleware('isCustomer');
Route::post('/add-refno/{id}', [UserController::class, 'CustconfirmPayment'])->name('add-refno')->middleware('isCustomer');


//forget password
Route::get('/forget-password', [ForgetPasswordController::class, 'viewForgetPassword'])->name('forget-password');
Route::post('/forgetpassword', [ForgetPasswordController::class, 'forgetPassword'])->name('forgetpassword');
Route::get('/reset-password/{token}', [ForgetPasswordController::class, 'reset'])->name('reset-password');
Route::post('/resetpassword', [ForgetPasswordController::class, 'resetPassword'])->name('resetpassword');


//admin controller
Route::get('/admin', [AdminController::class,'home'])->name('admin')->middleware('isAdmin');
Route::get('/admin-user', [AdminController::class,'displayUsers'])->name('admin-user')->middleware('isAdmin');
Route::get('/admin-service', [AdminController::class,'displayServices'])->name('admin-service')->middleware('isAdmin');
Route::get('/admin-booking', [AdminController::class,'displayBookings'])->name('admin-booking')->middleware('isAdmin');
Route::get('/admin-rate', [AdminController::class,'displayRating'])->name('admin-rates')->middleware('isAdmin');
Route::get('/admin-verify/{id}', [AdminController::class,'verifyUser'])->name('admin-verify')->middleware('isAdmin');
Route::get('/admin-deny/{id}', [AdminController::class,'denyUser'])->name('admin-deny')->middleware('isAdmin');
Route::get('/admin-ban/{id}', [AdminController::class,'banUser'])->name('admin-ban')->middleware('isAdmin');
Route::get('/admin-suspend/{id}', [AdminController::class,'suspendService'])->name('admin-suspend')->middleware('isAdmin');
Route::get("verified-user", [AdminController::class, "verifiedUsers"])->name("verified-user");
Route::get("pending-user", [AdminController::class, "unverifiedUsers"])->name("pending-user");
Route::get("denied-user", [AdminController::class, "deniedUsers"])->name("denied-user");
Route::get("banned-user", [AdminController::class, "bannedUsers"])->name("banned-user");
/*FOR VIEWS 
Route::get('/adminuser', function(){
    return view('admin.adminhome');
});
Route::get('/adminservice', function(){
    return view('admin.adminservice');
});
Route::get('/adminsrate', function(){
    return view('admin.adminrate');
});
*/








//messaging
Route::get('/provmsg', [UserController::class, 'provmsg'])->name('provmsg');
Route::get('/viewConversation/{id}', [UserController::class, 'viewConversation'])->name('viewConversation');
Route::get('/custmsg', [UserController::class, 'custmsg'])->name('custmsg');
Route::get('/viewConversationCustomer/{id}', [UserController::class, 'viewConversationCustomer'])->name('viewConversationCustomer');
Route::post('/send-message', [UserController::class, 'sendMessage'])->name('sendMessage');


Route::get('/search', [UserController::class, 'searchServices'])->name('search');
Route::get('/search-service', [UserController::class, 'searchServicesC'])->name('search-service')->middleware('isCustomer');
Route::get("service", [UserController::class, "service"])->name("service");
Route::get("available-services", [UserController::class, "displayAvailable"])->name("available-services");
Route::get("unavailable-services", [UserController::class, "displayUnavailable"])->name("unavailable-services");


//deniedusers
Route::get('/resend', [DeniedUserController::class, 'viewSendLink'])->name('resend');
Route::post('/get-email', [DeniedUserController::class, 'getEmail'])->name('get-email');
Route::get('/reregister/{token}', [DeniedUserController::class, 'reregister'])->name('reregister');
Route::post('/reregister-account', [DeniedUserController::class, 'reregisterAccount'])->name('reregister-account');
