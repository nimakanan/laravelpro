<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
public function __construct()
{
   $this->middleware("can:edit-users")->only(["edit","update"]);
   $this->middleware("can:create-users")->only(["create","store"]);
   $this->middleware("can:delete-users")->only(["destroy"]);
   $this->middleware("can:show-users")->only(["index"]);
   
}
    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::query();
        if ($keyword=request("search")) {
            
           $users->where('email' , 'LIKE' ,"%{$keyword}%")->orwhere('name' , 'LIKE' ,"%{$keyword}%")->orwhere('id'  ,$keyword);
        }
        if (request('admin')) {
            $this->authorize("show-staff-users");
            $users->where("is_superuser",1)->orwhere("is_stuff",1);
              }
        $users=$users->latest()->paginate(20);
        return view("admin.users.all",compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view("admin.users.create");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
     $data=$request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
     ]);
     $user=User::create($data);
     if($request->has("verify")){
         $user->markEmailAsVerified();
     }
     alert()->success("کاربر جدید با موفقیت ثبت نام شد.");
     return redirect (route("admin.users.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        // $this->authorize("edit-user",$user);
    return view("admin.users.edit",compact("user"));
}  
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data=$request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique("users")->ignore($user->id)],
         ]);
        if(! is_null($request->password)){

$request->validate([
    'password' => ['required', 'string', 'min:8', 'confirmed'],

]);
$data['password']=$request->password;

        }
        $user->update($data);
        if($request->has("verify")){
            $user->markEmailAsVerified();
        }
        return redirect (route("admin.users.index"));
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        alert()->success('کاربر مورد نظر با موفقیت حذف شد.');
        return back();
       
    }
}
