@extends('layouts.app')

@section('content')

<div class="wrapper without_header_sidebar">
    <div class="container">
        <div class="row d-flex flex-column justify-content-center align-items-center">
            <div class="col-lg-4 d-flex flex-column justify-content-center align-items-center">
                <div class="content"
                    style="border: 2px solid #ddd; padding: 30px 30px;  border-radius: 5px; background: #fafafa;">

                    @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to the email address you provided during
                        registration.') }}
                    </div>
                    @endif

                    <div class="mt-4 d-flex  flex-column justify-content-center align-items-center">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <div>
                                <button type="submit" class="btn btn-info">
                                    {{ __('Resend Verification Email') }}
                                </button>
                            </div>
                        </form>
                        <br>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="btn btn-info">
                                {{ __('Log Out') }}
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
