

@extends('layouts.app')

@section('content')

<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-8 card"><br>
                <h3 class="text-primary" >Change Your Password</h3>
                <br>
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
            <div class="col-4">
                <div class="card">
                    <img src="{{ asset('frontend/images/kaziariyan.png') }}" class="card-img-top" style="width: 90px; margin:0 auto;" alt="">
                  <div class="card-body">
                    <h5 class="card-title text-center">{{ Auth::user()->name }} </h5>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="{{ route('password.change') }}">
                            Change Password
                        </a>
                    </li>
                    <li class="list-group-item">one</li>
                    <li class="list-group-item">one</li>
                  </ul>
                  <div class="card-body">
                   <a class="btn btn-danger btn-sm btn-block" href="{{ route('user.logout') }}">Logout</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


