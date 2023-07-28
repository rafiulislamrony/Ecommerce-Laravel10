<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('panel/assets/images/favicon.png') }}">
    <!--Page title-->
    <title>Admin easy Learning</title>
    <!--bootstrap-->
    <link rel="stylesheet" href="{{ asset('panel/assets/css/bootstrap.min.css') }}">
    <!--font awesome-->
    <link rel="stylesheet" href="{{ asset('panel/assets/css/all.min.css') }}">
    <!-- metis menu -->
    <link rel="stylesheet" href="{{ asset('panel/assets/plugins/metismenu-3.0.4/assets/css/metisMenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/assets/plugins/metismenu-3.0.4/assets/css/mm-vertical-hover.css') }}">
    <!-- chart -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <!-- <link rel="stylesheet" href="assets/plugins/chartjs-bar-chart/chart.css"> -->
    <!--Custom CSS-->
    <link rel="stylesheet" href="{{ asset('panel/assets/css/style.css') }}">
</head>

<body id="page-top">
    <!-- preloader -->
    <div class="preloader">
        <img src="{{ asset('panel/assets/images/preloader.gif') }}" alt="">
    </div>


    <div class="wrapper without_header_sidebar">
        <!-- contnet wrapper -->
        <div class="content_wrapper">
            <!-- page content -->
            <div class="registration_page center_container">
                <div class="center_content">
                    <div class="logo">
                        <img src="panel/assets/images/logo.png" alt="" class="img-fluid">
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group icon_parent">
                            <label for="name">Username</label>
                            <input id="name" type="text" class="form-control"  name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Full Name">

                            <span class="icon_soon_bottom_right"><i class="fas fa-user"></i></span>
                        </div>
                        <div class="form-group icon_parent">
                            <label for="email">E-mail</label>
                            <input id="email" type="email" class="form-control" name="email" :value="old('email')" required autocomplete="username" placeholder="Email Address">
                            <span class="icon_soon_bottom_right"><i class="fas fa-envelope"></i></span>
                        </div>

                        <div class="form-group icon_parent">
                            <label for="password">Password</label>
                            <input id="password" class="form-control" type="password"
                            name="password" required autocomplete="new-password" placeholder="Password">
                            <span class="icon_soon_bottom_right"><i class="fas fa-unlock"></i></span>
                        </div>


                        <div class="form-group icon_parent">
                            <label for="password_confirmation">Re-type Password</label>
                            <input id="password_confirmation" type="password" class="form-control"
                            name="password_confirmation" required autocomplete="new-password"
                                placeholder="Confirm Password">
                            <span class="icon_soon_bottom_right"><i class="fas fa-unlock"></i></span>
                        </div>
                        <div class="form-group">
                            <a class="registration" href="{{ route('login') }}">Already have an account</a><br>
                            <button type="submit" class="btn btn-blue">Signup</button>
                        </div>
                    </form>
                    <div class="footer">
                        <p>Copyright &copy; 2020 <a href="https://easylearningbd.com/">easy Learning</a>. All rights
                            reserved.</p>
                    </div>
                </div>
            </div>
        </div><!--/ content wrapper -->
    </div><!--/ wrapper -->




    <!-- jquery -->
    <script src="{{ asset('panel/assets/js/jquery.min.js') }}"></script>
    <!-- popper Min Js -->
    <script src="{{ asset('panel/assets/js/popper.min.js') }}"></script>
    <!-- Bootstrap Min Js -->
    <script src="{{ asset('panel/assets/js/bootstrap.min.js') }}"></script>
    <!-- Fontawesome-->
    <script src="{{ asset('panel/assets/js/all.min.js') }}"></script>
    <!-- metis menu -->
    <script src="{{ asset('panel/assets/plugins/metismenu-3.0.4/assets/js/metismenu.js') }}"></script>
    <script src="{{ asset('panel/assets/plugins/metismenu-3.0.4/assets/js/mm-vertical-hover.js') }}"></script>
    <!-- nice scroll bar -->
    <script src="{{ asset('panel/assets/plugins/scrollbar/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('panel/assets/plugins/scrollbar/scroll.active.js') }}"></script>
    <!-- counter -->
    <script src="{{ asset('panel/assets/plugins/counter/js/counter.js') }}"></script>
    <!-- chart -->
    <script src="{{ asset('panel/assets/plugins/chartjs-bar-chart/Chart.min.js') }}"></script>
    <script src="{{ asset('panel/assets/plugins/chartjs-bar-chart/chart.js') }}"></script>
    <!-- pie chart -->
    <script src="{{ asset('panel/assets/plugins/pie_chart/chart.loader.js') }}"></script>
    <script src="{{ asset('panel/assets/plugins/pie_chart/pie.active.js') }}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        var message = "{{ Session::get('message') }}"; // Wrap in double curly braces
        switch (type) {
            case 'info':
                toastr.info(message);
                break;
            case 'success':
                toastr.success(message);
                break;
            case 'warning':
                toastr.warning(message);
                break;
            case 'error':
                toastr.error(message);
                break;
            default:
                toastr.info(message);
                break;
        }
    @endif
</script>


    <!-- Main js -->
    <script src="{{ asset('panel/assets/js/main.js') }}"></script>

</body>

</html>
