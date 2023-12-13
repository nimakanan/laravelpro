@component("admin.layouts.content",["title"=>" محصولات"])
@slot("breadcrump")
<li class="breadcrumb-item"><a href="/admin"> مدیریت</a></li>
{{-- <li class="breadcrumb-item" active>همه دسترسی ها </li> --}}
@endslot
<div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">جدول  محصولات</h3>

                <div class="card-tools d-flex">
              <div class="btn-group-sm mr-5">
                @can("create-products")
              <a href="{{route('admin.products.create')}}" class="btn btn-info ml-2">ایجاد محصول  جدید</a>
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
                    <th>ای دی محصول</th>
                    <th>نام محصول</th>
                    <th> ویژگی ها</th>
                    <th>  قیمت</th>
                    <th>  موجودی</th>
                    <th>  مشاهده شده</th>
                    <th>اقدامات</th>
     
                  </tr>
                 @foreach($products as $product)
                 <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->title}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->inventory}}</td>
                    <td>{{$product->view_count}}</td>
                    <td class="d-flex">
                      <div class="row ">
                        <form action="{{route("admin.products.destroy",["product"=>$product->id])}}" method="post">
                          @csrf
                          @method("DELETE")
                          @can("delete-products")
                          <button  type="submit" class="btn btn-danger btn-sm ml-1" data-confirm-delete="true">حذف</button>
                          @endcan
                          @can('edit-products')
                          <a href="{{route('admin.products.edit',["product"=>$product->id])}}" class="btn btn-info btn-sm">ویرایش</a>
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
