<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{config("app.name")}} - @yield('title') </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <!-- CSS -->
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow">
    <div class="app-container">
        <div class="h-100 bg-img">
            <div class="d-flex h-100 justify-content-center align-items-center">
                <div class="mx-auto app-login-box col-md-8">
                    <div class="modal-dialog w-100 mx-auto">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <div class="login-img">
                                    <img src="/images/logovandoorn.jpg" alt="logo" />
                                </div>
                                @yield('content')
                                <div class="divider"></div>
                                <p class="mb-0">Geen account? <a href="javascript:void(0);" class="text-primary">Neem contact op.</a></p>
                            </div>
                            <div class="modal-footer clearfix text-center">
                                    {{date('Y')}}&copy; Van Doorn Geldermalsen BV
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
