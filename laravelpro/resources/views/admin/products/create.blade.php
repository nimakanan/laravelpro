@component("admin.layouts.content",["title"=>"ایجاد محصول"])
@slot("breadcrump")
<li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">محصولات</a></li>
<li class="breadcrumb-item">ایجاد محصول</li>
@endslot
<div class="row">
@include('admin.layouts.alert')
<div class="col-lg-12">
<div class="card-body">
<form action="{{route('admin.products.store')}}" method="post">
@csrf
<div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">عنوان محصول</label>

                    
                      <input type="text" name="title" class="form-control" id="title" placeholder="محصول جدید را وارد گنید" value="{{old("title")}}">
                    
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">ویژگی محصول</label>
                      <textarea class="form-control"  placeholder="ویژگی محصول را وارد کنید" name="description" id="description" cols="30" rows="10" value="{{old("description")}}"></textarea>
                    </div>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label"> قیمت</label>
                          <input class="form-control" type="number"  placeholder="قیمت را وارد کنید" name="price" id="price"  value="{{old("price")}}">
                      </div>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">موجودی انبار</label>
                          <input class="form-control" type="number"  placeholder=" موجودی انبار" name="inventory" id="inventory" value="{{old("inventory")}}" >
                      </div>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">مشاهده شده</label>
                          <input class="form-control" type="number"  placeholder=" مشاهده شده" name="view_count" id="view_count" value="{{old("view_count")}}">
                      </div>
                  
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">ثبت محصول</button>
                  <a href="{{route("admin.products.index")}}" class="btn btn-default float-left">لغو</a>
                </div>
                </form>
                </div>
                </div>
@endcomponent
