

@extends('layouts.app')

@section('content')
<!-- wrapper -->
<div class="wrapper without_header_sidebar">
    <!-- contnet wrapper -->
    <div class="content_wrapper">
        <!-- page content -->
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-6">
                    <form method="POST" action="{{ route('register') }}"  style="border: 2px solid #ddd; padding: 30px 30px;  border-radius: 5px; background: #fafafa;">
                        @csrf

                        <div class="form-group icon_parent">
                            <label for="name">Username</label>
                            <input id="name" type="text" class="form-control" name="name" :value="old('name')" required
                                autofocus autocomplete="name" placeholder="Full Name">
                        </div>
                        <div class="form-group icon_parent">
                            <label for="email">E-mail</label>
                            <input id="email" type="email" class="form-control" name="email" :value="old('email')" required
                                autocomplete="username" placeholder="Email Address">
                        </div>

                        <div class="form-group icon_parent">
                            <label for="password">Password</label>
                            <input id="password" class="form-control" type="password" name="password" required
                                autocomplete="new-password" placeholder="Password">
                        </div>


                        <div class="form-group icon_parent">
                            <label for="password_confirmation">Re-type Password</label>
                            <input id="password_confirmation" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="Confirm Password">
                        </div>
                        <div class="form-group">
                            <a class="d-block" href="{{ route('login') }}">Already have an account?</a><br>
                            <button type="submit" class="btn btn-primary">Signup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ content wrapper -->
</div>
<!--/ wrapper -->


@endsection
