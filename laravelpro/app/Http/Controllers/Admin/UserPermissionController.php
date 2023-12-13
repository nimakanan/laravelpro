<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    public function create(User $user){
       
        // return $user->roles->pluck("id")->toArray();
        return view("admin.users.userpermission",compact("user"));
    }
    public function store(Request $request, User $user){
        $data=$request->validate([
            'permissions' => ['required', 'array'],
            'roles' => ['required','array'],
         ]);
         $user->permissions()->sync($data["permissions"]);
         $user->roles()->sync($data['roles']);
        alert()->success("اطلاعات شما  با موفقیت ثبت شد.");
         return redirect (route("admin.users.index"));
    }
}
