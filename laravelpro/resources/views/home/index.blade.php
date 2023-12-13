@extends("layouts.master")
@section("content")
  <div class="container">
    {{-- <div class="row"> --}}
        {{-- <div class="col-md-12"> --}}
            @foreach ($product->chunk(4) as $row)
       <div class="row">
        @foreach ($row as $product)
           <div class="col-md-6">
            <div class="card">
<div class="card-body">
    <h6 class="card-title"></h6>
    <p class="card-text"></p>
    <a class="btn btn-primary">جزئیات محصول</a>
</div>
            </div>
        </div> 
        @endforeach
       </div>
            @endforeach
        {{-- </div> --}}
    {{-- </div> --}}
   
  </div>
                   
@endsection
