@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>View Order</h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Orders List</h6>
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">

                </table>
            </div>
        </div>
    </div>
</div>
@endsection
