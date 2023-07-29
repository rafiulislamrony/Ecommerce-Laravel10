@extends('../user_layouts')

@section('user_content')

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
                        <input id="name" type="text" class="form-control" name="name" :value="old('name')" required
                            autofocus autocomplete="name" placeholder="Full Name">

                        <span class="icon_soon_bottom_right"><i class="fas fa-user"></i></span>
                    </div>
                    <div class="form-group icon_parent">
                        <label for="email">E-mail</label>
                        <input id="email" type="email" class="form-control" name="email" :value="old('email')" required
                            autocomplete="username" placeholder="Email Address">
                        <span class="icon_soon_bottom_right"><i class="fas fa-envelope"></i></span>
                    </div>

                    <div class="form-group icon_parent">
                        <label for="password">Password</label>
                        <input id="password" class="form-control" type="password" name="password" required
                            autocomplete="new-password" placeholder="Password">
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
    </div>
    <!--/ content wrapper -->
</div>
<!--/ wrapper -->

@endsection
