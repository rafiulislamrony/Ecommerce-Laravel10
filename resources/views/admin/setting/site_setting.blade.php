@extends('admin.admin_layouts')

@section('admin_content')


<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <span class="breadcrumb-item active">Website Setting</span>
    </nav>

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Update Site Setting</h6>

            <form action="{{ route('update.site.setting') }}" method="POST">
                @csrf

                <input type="hidden" name="id" value="{{ $setting->id }}">

                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Phone One: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="phone_one"  required="" value="{{ $setting->phone_one }}">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Phone Two: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="phone_two"  required="" value="{{ $setting->phone_two }}">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Email: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="email" required="" name="email"  value="{{ $setting->email }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Company Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" required="" name="company_name"  value="{{ $setting->company_name }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Company Address: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" required="" name="company_address"  value="{{ $setting->company_address }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Company Facebook Link: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" required="" name="facebook"  value="{{ $setting->facebook }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Company Youtube Link: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" required="" name="youtube"  value="{{ $setting->youtube }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Company Instagram Link: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" required="" name="instagram"  value="{{ $setting->instagram }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Company Twitter Link: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" required="" name="twitter"  value="{{ $setting->twitter }}">
                            </div>
                        </div>


                    </div>
                    <div class="form-layout-footer">
                        <button type="submit" class="btn btn-info mg-r-5">Submit</button>
                    </div>
                </div>
            </form>

        </div><!-- sl-mainpanel -->
    </div>
</div>

@endsection
