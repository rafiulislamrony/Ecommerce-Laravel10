

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
                    <form method="POST" action="{{ route('password.update') }}"
                        style="border: 2px solid #ddd; padding: 30px 30px;  border-radius: 5px; background: #fafafa;">
                        @csrf
                        @method('put')

                        <div class="form-group icon_parent">
                            <label for="current_password"> Current Password</label>
                            <input class="form-control" id="current_password" name="current_password" type="password"  autocomplete="current-password">
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-danger" />
                        </div>
                        <div class="form-group icon_parent">
                            <label for="password"> Password</label>
                            <input class="form-control" id="password" name="password" type="password" autocomplete="new-password">
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger" />
                        </div>

                        <div class="form-group icon_parent">
                            <label for="password_confirmation"> Confirm Password</label>
                            <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-danger" />
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="btn btn-primary">Save</button>
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

