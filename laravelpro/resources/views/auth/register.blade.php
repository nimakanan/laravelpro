@extends("layouts.master")
@section("content")
    <div class="page-links">
        <a href="{{route("login")}}">ورود</a><a href="{{route("register")}}" class="active">عضویت</a>
    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name"  placeholder="نام کامل" value="{{ old('name') }}" required autocomplete="name" autofocus >
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" placeholder="آدرس ایمیل" value="{{ old('email') }}" required autocomplete="email" >
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" placeholder="رمز عبور"  required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <input class="form-control" id="password-confirm" type="password" name="password_confirmation" placeholder="تکرار رمز عبور" required autocomplete="new-password">
                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn">عضویت</button>
                        </div>
                    </form>
                    <div class="other-links">
                        <span>یا عضویت با</span><a href="register14.html#"><i class="fab fa-facebook-f"></i></a><a href=""><i class="fab fa-google"></i></a><a href="{{route("auth.google")}}"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


