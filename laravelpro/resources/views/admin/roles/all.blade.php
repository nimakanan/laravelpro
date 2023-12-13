@component("admin.layouts.content",["title"=>"مقام ها"])
@slot("breadcrump")
<li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
<li class="breadcrumb-item" active>همه  مقام ها </li>
@endslot
<div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">جدول  مقام ها</h3>

                <div class="card-tools d-flex">
              <div class="btn-group-sm mr-5">
                @can("create-roles")
              <a href="{{route('admin.roles.create')}}" class="btn btn-info ml-2">ایجاد مقام  جدید</a>
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
                    <th>نام مقام ها</th>
                    <th>توضیح مقام ها</th>
                    <th>اقدامات</th>
     
                  </tr>
                 @foreach($roles as $role)
                 <tr>
                    <td>{{$role->name}}</td>
                    <td>{{$role->label}}</td>
                    <td class="d-flex">
                      <div class="row ">
                        <form action="{{route("admin.roles.destroy",["role"=>$role->id])}}" method="post">
                          @csrf
                          @method("DELETE")
                          @can("delete-roles")
                          <button  type="submit" class="btn btn-danger btn-sm ml-1">حذف</button>
                          @endcan
                          @can('edit-roles')
                          <a href="{{route('admin.roles.edit',["role"=>$role->id])}}" class="btn btn-info btn-sm">ویرایش</a>
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
