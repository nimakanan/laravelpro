@extends("layouts.master")
@section("content")
    <div class="page-links">
        <a href="{{route("profile")}}" class="active">خانه</a><a href="{{route("twofactor")}}">اهراز هویت دومرحله ای</a>
    </div>
    <form method="POST" action="{{route("login")}}">
        @csrf
        <input class="form-control @error('email') is-invalid @enderror" type="text" id="email"  name="email" placeholder="آدرس ایمیل" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="رمز عبور" required autocomplete="current-password">
        @error('password')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

        </div>
        <div class="form-button">
            <button id="submit" type="submit" class="ibtn">ارسال</button>
        </div>
    </form>
@endsection
