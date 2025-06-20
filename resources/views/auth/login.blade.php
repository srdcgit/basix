<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>LOGIN | BKSL </title>

    <!-- Global stylesheets -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('front/image/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('user_asset/global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('user_asset/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('user_asset/assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('user_asset/assets/css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('user_asset/assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('user_asset/assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    <link href="{{ asset('user_asset/assets/css/toastr.css') }}" rel="stylesheet" type="text/css">

    <!-- Core JS files -->
    <script src="{{ asset('user_asset/global_assets/js/main/jquery.min.js') }}"></script>
    <script src="{{ asset('user_asset/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user_asset/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ asset('user_asset/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>

    <script src="{{ asset('user_asset/assets/js/app.js') }}"></script>
    <script src="{{ asset('user_asset/global_assets/js/demo_pages/login.js') }}"></script>
    <!-- /theme JS files -->

</head>

<body class="bg-slate-800">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content d-flex justify-content-center align-items-center">

                <!-- Login card -->
                <form class="login-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img src="https://bkslmis.in/user_asset/global_assets/images/basix.jpg" alt="image" style="width:200px;margin-bottom:10px">
                                <h5 class="mb-0">Login to your account</h5>
                               
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="text" name="identifier" class="form-control"
                                    placeholder="Employee Code/Mobile Number">
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Sign in <i
                                        class="icon-circle-right2 ml-2"></i></button>
                            </div>
                            {{-- <p  class="text-center">Want To Register with the University?</p>
							<a href="{{url('register')}}"><button type="button" class="btn btn-primary btn-block">Register Now <i class="icon-circle-right2 ml-2"></i></button></a>	
							<p  class="text-center">Register as Prospect?</p>
							<a href="{{url('prospect/register')}}"><button type="button" class="btn btn-primary btn-block">Register Prospect Now <i class="icon-circle-right2 ml-2"></i></button></a>							 --}}
                        </div>
                    </div>
                </form>
                <!-- /login card -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->
    <script src="{{ asset('user_asset/assets/js/toastr.js') }}"></script>
    @toastr_render

</body>

</html>
