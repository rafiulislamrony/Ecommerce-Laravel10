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
                    <form method="POST" action="{{ route('login') }}"
                        style="border: 2px solid #ddd; padding: 30px 30px;  border-radius: 5px; background: #fafafa;">
                        @csrf
                        <div class="form-group icon_parent">
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" class="form-control" :value="old('email')"
                                required autofocus autocomplete="username" placeholder="Email Address">
                                <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
                        </div>
                        <div class="form-group icon_parent">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required
                                autocomplete="current-password" placeholder="Password">
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                        </div>
                        <div class="form-check position-relative">
                            <input class="form-check-input ml-0" type="checkbox" name="remember" id="remember_me">

                            <label class="form-check-label" for="remember_me">
                                Remember me
                            </label>
                        </div>

                        <div class="form-group d-flex justify-content-between">
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="registration">Create new account</a>
                            @endif
                            <br>

                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ content wrapper -->
</div>
<!--/ wrapper -->


@endsection
