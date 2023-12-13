@component("admin.layouts.content",["title"=>"ویرایش مقام"])
@slot("breadcrump")
<li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.roles.index')}}">مقام ها</a></li>
<li class="breadcrumb-item">ویرایش مقام</li>
@endslot
<div class="row">
@include('admin.layouts.alert')
<div class="col-lg-12">
<div class="card-body">
<form action="{{route('admin.roles.update',["role"=>$role->id])}}" method="post">
@csrf
@method("PATCH")
<div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">عنوان مقام</label>

                    
                      <input type="text" name="name" class="form-control" id="inputEmail3" value="{{old("name",$role->name)}}" placeholder="عنوان مقام را وارد کنید">
                    
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">توضیح مقام</label>
                      <input type="text" name="label" class="form-control" id="inputEmail3" value="{{old("label",$role->label)}}" placeholder="توضیح مقام خود را وارد کنید">
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"> دسترسی ها</label>
                     <select class="form-control" name="permissions[]" id="permission" multiple>
@foreach (App\Models\Permission::all() as $permission)
    <option value="{{$permission->id}}" {{in_array($permission->id,$role->permissions->pluck("id")->toArray())? "selected" :''}}>{{$permission->label}}</option>
@endforeach
                     </select>
                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">ویرایش مقام</button>
                  <a href="{{route("admin.roles.index")}}" class="btn btn-default float-left">لغو</a>
                </div>
                </form>
                </div>
                </div>
@endcomponent
