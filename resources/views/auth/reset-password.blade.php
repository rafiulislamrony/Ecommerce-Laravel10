


@extends('layouts.app')

@section('content')

<div class="wrapper without_header_sidebar">
    <div class="container">
        <div class="row d-flex flex-column justify-content-center align-items-center">
            <div class="col-lg-6 d-flex flex-column justify-content-center align-items-center">
                <div class="d-block"  style="width:100%; border: 2px solid #ddd; padding: 30px 30px;  border-radius: 5px; background: #fafafa;">
                    <form method="POST" action="{{ route('password.store') }}" class="d-block" >
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Address -->
                        <div class="form-group icon_parent">
                            <label for="email">Email</label>
                            <input id="email" class="form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="form-group icon_parent">
                            <label for="password">Password</label>
                            <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" >
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group icon_parent">
                            <label for="password_confirmation" :value="__('Confirm Password')"> Confirm Password </label>
                            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

