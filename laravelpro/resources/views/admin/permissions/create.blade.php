@component("admin.layouts.content",["title"=>"ایجاد دسترسی"])
@slot("breadcrump")
<li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.permissions.index')}}">همه دسترسی ها</a></li>
<li class="breadcrumb-item">ایجاد دسترسی</li>
@endslot
<div class="row">
@include('admin.layouts.alert')
<div class="col-lg-12">
<div class="card-body">
<form action="{{route('admin.permissions.store')}}" method="post">
@csrf
<div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">عنوان دسترسی</label>

                    
                      <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="دسترسی جدید را وارد گنید">
                    
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">توضیح دسترسی</label>
                      <input type="text" name="label" class="form-control" id="inputEmail3" placeholder="توضیح دسترسی جدید را وارد کنید">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">ثبت دسترسی</button>
                  <a href="{{route("admin.permissions.index")}}" class="btn btn-default float-left">لغو</a>
                </div>
                </form>
                </div>
                </div>
@endcomponent
