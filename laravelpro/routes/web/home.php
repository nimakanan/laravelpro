<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Models\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;


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

//   $user=User::find(1);
// //   dd(Gate::allows("edit-user",$user));
 
// //  if (Gate::allows("edit-user",$user)) {
// //   dd("yse");
// //  }
// //  dd("no");
//    $user=App\Models\User::find(4);
//    $user->notify(new \App\Notifications\LoginTowebsiteNotification());
// $user=Rule::find(1);
// return$user->users()->get();
// auth()->loginUsingId(1);
// if (Gate::allows("edit-users")) {

  return view('welcome');
  
// }
   
// return "no";

});

Auth::routes(['verify'=>true]);
Route::get("/auth/google",[App\Http\Controllers\Auth\GoogleAuthController::class,'redirect'])->name('auth.google');
Route::get("/login/auth/google",[App\Http\Controllers\Auth\GoogleAuthController::class,'callback'])->name('login.auth.google');
Route::get("/auth/token",[App\Http\Controllers\Auth\AuthTokencontroller::class,'gettoken'])->name('2fa.token');
Route::post("/auth/token",[App\Http\Controllers\Auth\AuthTokencontroller::class,'posttoken']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name("home")->middleware(["auth","verified"]);
Route::get("/secret",function (){
  return "HELLO NIMA" ;
})->middleware(['auth', 'password.confirm']);
Route::get("/register/phone",[App\Http\Controllers\Phone\RegisterPhoneController::class,"phone"])->name("register.phone");
Route::post("/register/phone",[App\Http\Controllers\Phone\RegisterPhoneController::class,"store"])->name("register.phone");

Route::middleware('auth')->group(function(){
    Route::get('/profile',[App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::get('/profiletwofactor',[App\Http\Controllers\ProfileController::class, 'manageTwoFactor'])->name('twofactor');
    Route::post('/profiletwofactor',[App\Http\Controllers\ProfileController::class, 'postManageTwoFactor'])->name('managetwofactor');
    Route::get('/profile/verifycode',[App\Http\Controllers\ProfileController::class,'getPhoneVerify'])->name('verifycode');
    Route::post('/profile/verifycode',[App\Http\Controllers\ProfileController::class,'postPhoneVerify']);
    Route::get("product",[\App\Http\Controllers\ProductController::class,'index']);
Route::get("product/{product}",[\App\Http\Controllers\ProductController::class,'single']);
      

    
});
