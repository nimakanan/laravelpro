@extends("layouts.master")
@section("content")
    <div class="page-links">
        <a href="{{route("login")}}" class="active">ورود</a><a href="{{route("register.phone")}}">عضویت</a>
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
                        <div class="form-group">
        @recaptcha

                            @error('g-recaptcha-response')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('مرا به خاطر بسپار') }}
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('رمز خود را فراموش کردید؟') }}
                            </a>
                        @endif
                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn">ورود</button>
                        </div>
                    </form>
    <div class="other-links">
        <span>یا ورود  با</span><a href="register14.html#"><i class="fab fa-facebook-f"></i></a><a href="{{route("auth.google")}}"><i class="fab fa-google"></i></a><a href="#"><i class="fab fa-linkedin-in"></i></a>
    </div>
@endsection
