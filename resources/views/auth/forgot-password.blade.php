@extends('layouts.app')

@section('content')

<div class="wrapper without_header_sidebar">
    <div class="container">
        <div class="row d-flex flex-column justify-content-center align-items-center">
            <div class="col-lg-4 d-flex flex-column justify-content-center align-items-center">
                <div class="content"
                    style="width:100%; border: 2px solid #ddd; padding: 30px 30px;  border-radius: 5px; background: #fafafa;">
                    <div class="mb-4 text-sm text-gray-600">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email
                        you a password reset link that will allow you to choose a new one.') }}
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <div class="mt-4 d-flex  flex-column justify-content-center align-items-center">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="form-group icon_parent">
                                <label for="email">Email</label>
                                <input id="email" type="email" name="email" class="form-control" :value="old('email')"
                                    required autofocus>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <button type="submit" class="btn btn-primary">Email Password Reset Link</button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
