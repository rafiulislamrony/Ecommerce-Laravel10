@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>View Message</h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <p>
            <span> Name: </span>
            <span> {{ $message->name }}</span>
          </p>
          <p>
            <span> Email: </span>
            <span> {{ $message->email }}</span>
          </p>
          <p>
            <span> Phone: </span>
            <span> {{ $message->phone }}</span>
          </p>
          <p>
            <span> Phone: </span>
            <span> {{ $message->message }}</span>
          </p>
        </div>
    </div>
</div>
@endsection
