@extends("layouts.master")
@section("content")
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

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
            <button id="submit" type="submit" class="ibtn">تغییر رمز عبور</button>
        </div>
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection


