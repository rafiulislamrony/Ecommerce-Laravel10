@extends('../user_layouts')

@section('user_content')


    <!-- wrapper -->
    <div class="wrapper without_header_sidebar">
        <!-- contnet wrapper -->
        <div class="content_wrapper">
            <!-- page content -->
            <div class="login_page center_container">
                <div class="center_content">
                    <div class="logo">
                        <img src="panel/assets/images/logo.png" alt="" class="img-fluid">
                    </div>
                    <form method="POST" class="d-block" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group icon_parent">
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" class="form-control" :value="old('email')"
                                required autofocus autocomplete="username" placeholder="Email Address">
                            <span class="icon_soon_bottom_right"><i class="fas fa-envelope"></i></span>
                        </div>
                        <div class="form-group icon_parent">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required
                                autocomplete="current-password" placeholder="Password">

                            <span class="icon_soon_bottom_right"><i class="fas fa-unlock"></i></span>
                        </div>
                        <div class="form-group">
                            <label for="remember_me" class="chech_container">Remember me
                                <input type="checkbox" name="remember" id="remember_me">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="form-group">
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="registration">Create new account</a>
                            @endif
                            <br>
                            @if (Route::has('password.request'))
                            <a class="text-white" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                            @endif
                            <button type="submit" class="btn btn-blue">Login</button>
                        </div>
                    </form>
                    <div class="footer">
                        <p>Copyright &copy; 2020 <a href="https://easylearningbd.com/">easy Learning</a>. All rights
                            reserved.</p>
                    </div>

                </div>
            </div>
        </div>
        <!--/ content wrapper -->
    </div>
    <!--/ wrapper -->


@endsection
