<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('assets/cool_dashboard/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/cool_dashboard/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('assets/cool_dashboard/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('assets/cool_dashboard/vendor/mdi-font/css/material-design-iconic-font.min.css') }}"
        rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('assets/cool_dashboard/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet"
        media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('assets/cool_dashboard/vendor/animsition/animsition.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('assets/cool_dashboard/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}"
        rel="stylesheet" media="all">
    <link href="{{ asset('assets/cool_dashboard/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/cool_dashboard/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('assets/cool_dashboard/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/cool_dashboard/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/cool_dashboard/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet"
        media="all">

    <!-- Main CSS-->
    <link href="{{ asset('assets/cool_dashboard/css/theme.css') }}" rel="stylesheet" media="all">
    <style>
        .login-as {
            margin-top: 20px;
        }

        .login-as h4 {
            font-weight: normal;
        }

        .login-as .buttons {
            margin-top: 10px;
            display: flex;
            justify-content: center;
            align-content: center;
        }

        .login-as .buttons a {
            padding: 5px 15px;
            margin: 5px;
            font-size: 14px;
        }
    </style>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="{{ asset('assets/cool_dashboard/images/icon/logo.png') }}" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>{{ trans('app.email') }}</label>
                                    <input class="au-input au-input--full" type="email" name="email"
                                        value="{{ old('email') }}" placeholder="{{ trans('app.email') }}">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('app.password') }}</label>
                                    <input class="au-input au-input--full" type="password" name="password"
                                        placeholder="{{ trans('app.password') }}">
                                    @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">{{ trans('app.remember_me') }}
                                    </label>

                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20"
                                    type="submit">{{ trans('app.sign_in') }}</button>

                            </form>
                            <div class="login-as">
                                <h4 class="text-center">{{ trans('app.login_as') }}</h4>
                                <div class="buttons">
                                    <a href="{{ route('loginAs', 'admin') }}"
                                        class="btn btn-danger">{{ trans('app.admin') }}</a>
                                    <a href="{{ route('loginAs', 'manager') }}"
                                        class="btn btn-primary">{{ trans('app.manager') }}</a>
                                    <a href="{{ route('loginAs', 'employee') }}"
                                        class="btn btn-info">{{ trans('app.employee') }}</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('assets/cool_dashboard/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('assets/cool_dashboard/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('assets/cool_dashboard/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('assets/cool_dashboard/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/cool_dashboard/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/cool_dashboard/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('assets/cool_dashboard/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('assets/cool_dashboard/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/cool_dashboard/vendor/counter-up/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/cool_dashboard/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('assets/cool_dashboard/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/cool_dashboard/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/cool_dashboard/vendor/select2/select2.min.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ asset('assets/cool_dashboard/js/main.js') }}"></script>

</body>

</html>
<!-- end document-->
