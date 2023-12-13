<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\UserPermissionController;
use Config\App;

Route::get('/',function(){
 return view("admin.layouts.index");
 
});
Route::get('users',function(){
    return view("admin.layouts.users.all");
});
Route::get("/user/{user}/permission",[\App\Http\Controllers\Admin\UserPermissionController::class,'create'])->name("users.permissions.create")->middleware("can::staff-user-permissions");
Route::post("/user/{user}/permission",[\App\Http\Controllers\Admin\UserPermissionController::class,'store'])->name("users.permissions.store")->middleware("can::staff-user-permissions");
Route::resource("users",'Admin\UserController');
Route::resource("permissions",'Admin\PermissionController');
Route::resource("roles",'Admin\RoleController');
Route::resource("products","Admin\ProductController")->except(["show"]);


