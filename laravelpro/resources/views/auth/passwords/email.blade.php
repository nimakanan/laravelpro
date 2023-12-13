@extends("layouts.master")
@section("content")
    <form method="POST" action="{{route("password.email")}}">
        @csrf
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        <input class="form-control @error('email') is-invalid @enderror" type="text" id="email"  name="email" placeholder="آدرس ایمیل" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
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
        <div class="form-button">
            <button id="submit" type="submit" class="ibtn">ارسال کد به ایمیل</button>
        </div>
    </form>
@endsection
