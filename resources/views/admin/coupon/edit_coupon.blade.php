@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Coupon Update</h5>

        </div><!-- sl-page-title -->
        <div class="row ">
            <div class="col-md-8">
                <div class="card pd-20 pd-sm-40">
                    <div class="table-wrapper">
                        <form action="{{ route('coupon.update', $coupon->id) }}" method="post">
                            @csrf
                            <div class="modal-body pd-20">
                                <div class="form-group">
                                    <label for="text1">Coupon Code</label>
                                    <input type="text" class="form-control" id="text1" name="coupon"
                                        value="{{ $coupon->coupon }}">
                                        @if ($errors->any())
                                        <ul class="text-danger" >
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                   @endif
                                </div>
                                <div class="form-group">
                                    <label for="text2">Coupon Discount (%)</label>
                                    <input type="text" class="form-control" id="text2" name="discount"
                                        value="{{ $coupon->discount }}">
                                        @if ($errors->any())
                                        <ul class="text-danger" >
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                   @endif
                                </div>

                            </div><!-- modal-body -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info pd-x-20">Update</button>
                            </div>
                        </form>
                    </div>

                    <!-- table-wrapper -->
                </div><!-- card -->
            </div>
        </div>
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->




    @endsection
