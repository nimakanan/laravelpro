@extends("layouts.master")
@section("content")
{{--    <p>{{auth()->user()->name()}}</p>--}}
    <p>لطفا کد ارسالی به شماره همراه خود را وارد کنید</p>
    <form method="POST" action="{{route("2fa.token")}}">
        @csrf
        <input class="form-control @error('token') is-invalid @enderror " type="text" name="token" placeholder="کد ارسالی را وارد کنید" required autocomplete="current-password">
        @error('token')
        <span class="invalid-feedback">
            <strong>{{$massage}}</strong>
        </span>

        @enderror
        <div class="form-button">
            <button id="submit" type="submit" class="ibtn">ارسال</button>
        </div>
    </form>
@endsection
