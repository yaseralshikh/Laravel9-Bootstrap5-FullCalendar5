<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | Log in (v2)</title>
        <link rel="icon" href="{{ asset('backend/img/sweeklyplan_logo.jpg') }}" type="image/icon type">
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}../../">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('backend/css/adminlte.min.css') }}">
    </head>

    <body class="hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <img src="{{ asset('backend/img/sweeklyplan_logo.jpg') }}" class="img-circle elevation-2">
                    <a href="{{ route('home') }}" class="h1"><b>Admin</b>LTE</a>
                    <h4 class="text-primary">خطة المشرف الأسبوعية</h4>
                    {{-- <h6>مكتب التعليم بوسط جازان - بنين</h6> --}}
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul dir="rtl">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h4 dir="rtl" class="login-box-msg text-center">الموقع تحت الصيانة ، نقدر انتظاركم .</h4>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('backend/js/adminlte.min.js') }}"></script>
    </body>

</html>
