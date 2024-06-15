<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\RealtorListingAcceptOfferController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;
use App\Http\Controllers\UserController;
use App\Notifications\OfferMadeNotification;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;

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
// Route::get('/',[IndexController::class,'index']);
Route::get('/', function () {
    dd('hellow');
});

Route::get('/show', [IndexController::class, 'show']);


Route::resource('/listing', ListingController::class,)->except(['destroy', 'edit', 'update', 'create', 'store']);


Route::get('login', [AuthController::class, 'create'])->name('login.create');

Route::post('login', [AuthController::class, 'store'])->name('login.store');

Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');

Route::resource('user', UserController::class);




Route::get('/email/verify',function (){
    return inertia('Auth/verify_email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification',function (Request $request){
    $request->user()->sendEmailVerificationNotification();
    return back()->with('success','Verification Email Is Sent To You Again!');
})->middleware(['auth','throttle:6,1'])->name('verification.send');




Route::prefix('realtor')->name('realtor.')->middleware(['auth','verified'])->group(function () {
    Route::name('listing.restore')->put('listing/{listing}/restore', [RealtorListingController::class, 'restore']);
    Route::resource('listing', RealtorListingController::class)->withTrashed();
    // Route::get('123',function (){
    //     return "12333";
    // })->name('123name');
    Route::name('offer.accept')->put('offer/{offer}/accept', RealtorListingAcceptOfferController::class);
    Route::resource('listing.image', RealtorListingImageController::class)->only(['create', 'store', 'destroy']);
});

Route::resource('notification', NotificationController::class)->middleware('auth')->only(['index']);

// Route::name('notification.seen')->put('notification/{notification}/seen',function (OfferMadeNotification $notif){
//     dd($notif);
// });

Route::put(
    'notification/{notification}/seen',
    NotificationSeenController::class
)->middleware('auth')->name('notification.seen');


Route::resource('listing.offer', ListingOfferController::class)->middleware('auth')->only(['store']);
