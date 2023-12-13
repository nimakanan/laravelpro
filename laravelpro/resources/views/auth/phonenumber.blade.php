@extends("layouts.master")
@section("content")
    <div class="page-links">
        <a href="/">خانه</a>
    </div>
    <form method="POST" action="{{route("register.phone")}}">
        @csrf
        <input class="form-control @error('phone') is-invalid @enderror " type="text" name="phone" placeholder="شماره تلفن خود را وارد کنید">
        @error('phone')
        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
        @enderror
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="form-check-label" for="remember">
                {{ __('مرا به خاطر بسپار') }}
            </label>
        </div>
        <div class="form-button">
            <button id="submit" type="submit" class="ibtn">ثبت</button>
        </div>
    </form>
@endsection
