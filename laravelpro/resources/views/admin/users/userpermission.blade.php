@component("admin.layouts.content",["title"=>"ایجاد دسترسی"])
@slot("breadcrump")
<li class="breadcrumb-item" active><a href="/admin">پنل مدیریت</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">لیست کاربران</a></li>
<li class="breadcrumb-item"> ایجاد دسترسی</li>
@endslot
<div class="row">
@include('admin.layouts.alert')
<div class="col-lg-12">
<div class="card-body">
<form action="{{route('admin.users.permissions.store',["user"=>$user->id])}}" method="post">
@csrf
<div class="form-group">
  <label for="inputEmail3" class="col-sm-2 control-label"> دسترسی ها</label>
   <select class="form-control" name="permissions[]" id="" multiple>
@foreach (App\Models\Permission::all() as $permission)
<option value="{{$permission->id}}" {{in_array($permission->id,$user->permissions->pluck("id")->toArray())? "selected" :''}}>{{$permission->label}}</option>
@endforeach
   </select>
</div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">مقام ها</label>
                    <select name="roles[]" id="" class="form-control" multiple>
                      @foreach (\App\Models\Role::all() as $role)
                         <option  value="{{$role->id}}" {{in_array($role->id,$user->roles->pluck("id")->toArray())? "selected" :''}}>{{$role->label}}</option> 
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">ثبت</button>
                  <button type="submit" class="btn btn-default float-left">لغو</button>
                </div>
                </form>
                </div>
                </div>
@endcomponent
