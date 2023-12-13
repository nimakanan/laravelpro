@component("admin.layouts.content",["title"=>"لیست کاربران"])
@slot("breadcrump")
<li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
<li class="breadcrumb-item" active>لیست کاربران</li>
@endslot
<div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">جدول کاربران</h3>

                <div class="card-tools d-flex">
              <div class="btn-group-sm mr-5">
                @can("show-staff-users")
                <a href="{{request()->FullUrlWithQuery(['admin'=>1])}}" class="btn btn-warning ml-1">کاربران مدیر</a>
                @endcan
                @can("create-users")
                <a href="{{route('admin.users.create')}}" class="btn btn-info ml-2">ایجاد کاربر جدید</a> 
                @endcan
              
              </div>
              <form action="">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="search" class="form-control float-right" placeholder="جستجو" value="{{request('search')}}">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </form>
                
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ای دی کاربر</th>
                    <th>نام کاربر</th>
                    <th> ایمیل</th>
                    <th>وضعیت ایمیل</th>
                    <th>اقدامات</th>
     
                  </tr>
                 @foreach($users as $user)
                 <tr>                 
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    @if($user->email_verified_at)
<td><span class="badge badge-success">فعال</span></td>

                   @else
                    <td><span class="badge badge-danger">غیرفعال</span></td>
                    @endif
                    <td class="d-flex">
                      <div class="row ">
                        <form action="{{route("admin.users.destroy",["user"=>$user->id])}}" method="post">
                          @csrf
                          @method("DELETE")
                          @if (!$user->is_superuser())
                          @can("delete-users")
                          <button  type="submit" class="btn btn-danger btn-sm ml-1">حذف</button>
                          @endcan                                                                                         
                         <a href="{{route('admin.users.edit',["user"=>$user->id])}}" class="btn btn-info btn-sm ml-1">ویرایش</a>                                          
                          @can("staff-user-permissions")
                          @if($user->is_stuff()||$user->is_superuser())
                          <a href="{{route('admin.users.permissions.create',["user"=>$user->id])}}" class="btn btn-warning btn-sm">دسترسی ها</a>
                          @endif
                          
                          @endcan 
                          @endif
                          
                         
                        </form>
               
                      </div>
 
                    </td>
                  </tr>
                  
                  

                 @endforeach
                 
                  
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

@endcomponent
