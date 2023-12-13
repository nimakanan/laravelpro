<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
       $this->middleware("can:edit-permissions")->only(["edit","update"]);
       $this->middleware("can:create-permissions")->only(["create","store"]);
       $this->middleware("can:delete-permissions")->only(["destroy"]);
       $this->middleware("can:show-permissions")->only(["index"]);
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions=Permission::query();
        if ($keyword=request("search")) {
            
           $permissions->where('name' , 'LIKE' ,"%{$keyword}%")->orwhere('label' , 'LIKE' ,"%{$keyword}%")->orwhere('id'  ,$keyword);
        //    return $keyword;
        }
        $permissions=$permissions->latest()->paginate(20);
        return view("admin.permissions.all",compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.permissions.create");
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
            'name' => ['required', 'string', 'max:255','unique:permissions'],
            'label' => ['required', 'string','max:255'],
         ]);
         $permission=Permission::create($data);
         alert()->success("دسترسی مورد نظر با موفقیت ثبت شد.");
         return redirect (route("admin.permissions.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view("admin.permissions.edit",compact("permission"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $data=$request->validate([
            'name' => ['required', 'string', 'max:255',Rule::unique("permissions")->ignore($permission->id)],
            'label' => ['required', 'string', 'max:255'],
         ]);
        $permission->update($data);
        alert()->success("مطلب مورد نظر با موفقیت ویرایش شد.");
        return redirect (route("admin.permissions.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        alert()->success('کاربر مورد نظز با موفقیت حذف گردید.');
        return back();
        
    }
}
