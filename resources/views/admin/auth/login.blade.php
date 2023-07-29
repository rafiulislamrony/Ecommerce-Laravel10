@extends('admin.admin_layouts')

@section('admin_content')

<div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

    <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
        <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Admin <span
                class="tx-info tx-normal">Login</span>
        </div>

        <form method="POST" class="d-block" action="{{ route('admin.login') }}">
            @csrf
                <div class="form-group icon_parent">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" class="form-control" :value="old('email')"
                        required autofocus autocomplete="username" placeholder="Email Address">
                </div>
                <div class="form-group icon_parent">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required
                        autocomplete="current-password" placeholder="Password">
                </div>
                <div class="form-group d-flex justify-content-between">
                    <label for="remember_me" class="chech_container">Remember me
                        <input type="checkbox" name="remember" id="remember_me">
                        <span class="checkmark"></span>
                    </label>
                    @if (Route::has('password.request'))
                    <a  href="{{ route('password.request') }}">
                       Forgot password?
                    </a>
                    @endif
                </div>
            <button type="submit" class="btn btn-info btn-block">Sign In</button>

            <div class="mg-t-60 tx-center">Not yet a member?
                <a href="page-signup.html" class="tx-info">Sign Up</a>
            </div>
        </form>
    </div><!-- login-wrapper -->
</div><!-- d-flex -->




@endsection
