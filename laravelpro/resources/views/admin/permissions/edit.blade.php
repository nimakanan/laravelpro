@component("admin.layouts.content",["title"=>"ویرایش دسترسی"])
@slot("breadcrump")
<li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.permissions.index')}}">دسترسی ها</a></li>
<li class="breadcrumb-item">ویرایش دسترسی</li>
@endslot
<div class="row">
@include('admin.layouts.alert')
<div class="col-lg-12">
<div class="card-body">
<form action="{{route('admin.permissions.update',["permission"=>$permission->id])}}" method="post">
@csrf
@method("PATCH")
<div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">عنوان دسترسی</label>

                    
                      <input type="text" name="name" class="form-control" id="inputEmail3" value="{{old("name",$permission->name)}}" placeholder="عنوان دسترسی را وارد کنید">
                    
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">توضیح دسترسی</label>
                      <input type="text" name="label" class="form-control" id="inputEmail3" value="{{old("label",$permission->label)}}" placeholder="توضیح دسترسی خود را وارد کنید">
                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">ویرایش دسترسی</button>
                  <a href="{{route("admin.permissions.index")}}" class="btn btn-default float-left">لغو</a>
                </div>
                </form>
                </div>
                </div>
@endcomponent
