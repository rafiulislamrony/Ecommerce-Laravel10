@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <a class="btn btn-info"  href="{{ route('user.logout') }}"><span><i class="fas fa-unlock-alt"></i></span> Logout</a>
        </div>
    </div>
</div>

@endsection
