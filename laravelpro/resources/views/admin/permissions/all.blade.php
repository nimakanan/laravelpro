@component("admin.layouts.content",["title"=>"دسترسی ها"])
@slot("breadcrump")
<li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
<li class="breadcrumb-item" active>همه دسترسی ها </li>
@endslot
<div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">جدول دسترسی ها</h3>

                <div class="card-tools d-flex">
              <div class="btn-group-sm mr-5">
                @can("create-permissions")
              <a href="{{route('admin.permissions.create')}}" class="btn btn-info ml-2">ایجاد دسترسی  جدید</a>
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
                    <th>نام دسترسی</th>
                    <th>توضیح دسترسی</th>
                    <th>اقدامات</th>
     
                  </tr>
                 @foreach($permissions as $permission)
                 <tr>
                    <td>{{$permission->name}}</td>
                    <td>{{$permission->label}}</td>
                    <td class="d-flex">
                      <div class="row ">
                        <form action="{{route("admin.permissions.destroy",["permission"=>$permission->id])}}" method="post">
                          @csrf
                          @method("DELETE")
                          @can("delete-permissions")
                          <button  type="submit" class="btn btn-danger btn-sm ml-1">حذف</button>
                          @endcan
                          @can('edit-permissions')
                          <a href="{{route('admin.permissions.edit',["permission"=>$permission->id])}}" class="btn btn-info btn-sm">ویرایش</a>
                          @endcan
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
