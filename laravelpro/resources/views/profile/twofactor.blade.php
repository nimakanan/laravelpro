@extends("layouts.master")
@section("content")
    <div class="page-links">
        <a href="{{route("profile")}}">خانه</a><a href="{{route("twofactor")}}" class="active">اهراز هویت دو مرحله ای</a>
    </div>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{route("managetwofactor")}}">
        @csrf
        <div class="form-group">
       <select class="form-control" name="type" id="type">
          @foreach(config('twofactor.types') as  $key=>$name)
               <option value="{{$key}} {{old("type")== $key||auth()->user()->hasfactor($key)?'selected':""}}">{{$name}}</option>
           @endforeach
       </select>
        </div>
        <input class="form-control " type="text" name="phone" placeholder="شماره تلفن خود را وارد کنید"  value=" {{old('phone')?? auth()->user()->phone_number}}">
        <div class="form-button">
            <button id="submit" type="submit" class="ibtn">بروزرسانی</button>
        </div>
    </form>
@endsection
