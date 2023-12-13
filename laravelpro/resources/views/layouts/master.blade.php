
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iform ورود و ثبت نام با</title>

    <link rel="stylesheet" type="text/css" href="{{asset("css/form.css/rtl.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("css/form.css/bootstrap.min.css")}}">

    <link rel="stylesheet" type="text/css" href="{{asset("css/form.css/fontawesome-all.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("css/form.css/iofrm-style.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("css/form.css/iofrm-theme14.css")}}">
</head>
<div class="form-body">
    <div class="row">
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <div class="website-logo-inside">
                        <a href="index.html">
{{--                            <div class="logo">--}}
{{--                                <img class="logo-size" src="image/logo-light.svg" alt="">--}}
{{--                            </div>--}}
                        </a>
                    </div>
                    <main>
                        @yield("content")
                    </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@yield('script')
<script src="{{asset("/js/app.js")}}"></script>
@include('sweetalert::alert')


<script type="text/javascript" src="{{asset("js/form.js/jquery.min.js")}}"></script>
<script type="text/javascript" src="{{asset("js/form.js/popper.min.js")}}"></script>
<script type="text/javascript" src="{{asset("js/form.js/bootstrap.min.js")}}"></script>
<script type="text/javascript" src="{{asset("js/form.js/main.js")}}"></script>
</html>

