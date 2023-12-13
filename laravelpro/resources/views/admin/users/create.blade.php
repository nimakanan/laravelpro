@component("admin.layouts.content",["title"=>"ایجاد کاربر"])
@slot("breadcrump")
<li class="breadcrumb-item" active>پنل مدیریت</li>
<li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">لیست کاربران</a></li>
<li class="breadcrumb-item"><a href="/admin/users">ایجاد کاربر</a></li>
@endslot
<div class="row">
@include('admin.layouts.alert')
<div class="col-lg-12">
<div class="card-body">
<form action="{{route('admin.users.store')}}" method="post">
@csrf
<div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">نام</label>

                    
                      <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="نام خود را وارد کنید">
                    
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">ایمیل</label>
                      <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="ایمیل را وارد کنید">
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">پسورد</label>

                    
                      <input type="password"id="password"  name="password" class="form-control"  placeholder="پسورد را وارد کنید">
                    
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">تکرار پسورد</label>

                    
                      <input type="password" id="password_confirm" name="password_confirmation" class="form-control"  placeholder="پسورد را وارد کنید">
                    
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" name="verify" class="form-check-input" id="validate">
                        <label class="form-check-label" for="validate">اکانت فعال باشد</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">ثبت نام</button>
                  <a href="{{route("admin.users.index")}}" class="btn btn-default float-left">لغو</a>
                </div>
                </form>
                </div>
                </div>
@endcomponent
