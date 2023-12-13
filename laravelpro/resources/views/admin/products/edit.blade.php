@component("admin.layouts.content",["title"=>"ویرایش محصول"])
@slot("breadcrump")
<li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.products.index')}}"> محصولات</a></li>
<li class="breadcrumb-item">ویرایش محصول</li>
@endslot
<div class="row">
@include('admin.layouts.alert')
<div class="col-lg-12">
<div class="card-body">
<form action="{{route('admin.products.update',["product"=>$product->id])}}" method="post">
@csrf
@method("PATCH")
<div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">عنوان محصول</label>       
                      <input type="text" name="title" class="form-control" id="title" value="{{old("title",$product->title)}}" placeholder="عنوان محصول را وارد کنید">     
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">ویژگی محصول</label>
                      <textarea class="form-control"  placeholder="ویژگی محصول را وارد کنید" name="description" id="description" cols="30" rows="10">{{old("description",$product->description)}}</textarea>
                    </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"> قیمت</label>
                      <input type="number" name="price" class="form-control" id="price" value="{{old("price",$product->price)}}" placeholder="قیمت را وارد کنید">
                  </div>
                   <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">موجودی انبار</label>
                      <input type="number" name="inventory" class="form-control" id="inventory" value="{{old("inventory",$product->inventory)}}" placeholder="موجودی انبار">
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">مشاهده شده</label>
                      <input type="number" name="view_count" class="form-control" id="view_count" value="{{old("view_count",$product->view_count)}}" placeholder="مشاهده شده">
                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">ویرایش محصول</button>
                  <a href="{{route("admin.products.index")}}" class="btn btn-default float-left">لغو</a>
                </div>
                </form>
                </div>
                </div>
@endcomponent
