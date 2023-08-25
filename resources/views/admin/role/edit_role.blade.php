@extends('admin.admin_layouts')

@section('admin_content')


<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <span class="breadcrumb-item active">Admin Section</span>
    </nav>

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Update Admin</h6>

            <form action="{{ route('update.admin') }}" method="POST">
                @csrf

                <input type="hidden" name="id" value="{{ $user->id }}">

                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="name"  required="" value="{{ $user->name }}">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Phone: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="phone"  required="" value="{{ $user->phone }}">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Email: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="email" required="" name="email"  value="{{ $user->email }}">
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- row -->
                    <br>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="category"
                                <?php if ($user->category == 1) {
                                    echo "checked";
                                } ?> >
                                <span> Category</span>
                            </label>
                        </div>

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="coupon"<?php if ($user->coupon == 1) {
                                    echo "checked";
                                } ?>>
                                <span> Coupon</span>
                            </label>
                        </div>

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="products"<?php if ($user->products == 1) {
                                    echo "checked";
                                } ?>>
                                <span>Products</span>
                            </label>
                        </div>

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="blog"<?php if ($user->blog == 1) {
                                    echo "checked";
                                } ?>>
                                <span>Blog</span>
                            </label>
                        </div>

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="orders"<?php if ($user->orders == 1) {
                                    echo "checked";
                                } ?>>
                                <span>Orders</span>
                            </label>
                        </div>

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="other"<?php if ($user->other == 1) {
                                    echo "checked";
                                } ?>>
                                <span>Other</span>
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="report"<?php if ($user->report == 1) {
                                    echo "checked";
                                } ?>>
                                <span>Report</span>
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="role"<?php if ($user->role == 1) {
                                    echo "checked";
                                } ?>>
                                <span>Role</span>
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="returns"<?php if ($user->returns == 1) {
                                    echo "checked";
                                } ?>>
                                <span>Returns</span>
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="contact"<?php if ($user->contact == 1) {
                                    echo "checked";
                                } ?>>
                                <span>Contact</span>
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="comment"<?php if ($user->comment == 1) {
                                    echo "checked";
                                } ?>>
                                <span>Comment</span>
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="setting"<?php if ($user->setting == 1) {
                                    echo "checked";
                                } ?>>
                                <span>Setting</span>
                            </label>
                        </div>
                    </div> <!-- End ROw -->
                    <br><br>
                    <div class="form-layout-footer">
                        <button type="submit" class="btn btn-info mg-r-5">Submit</button>
                    </div>
                </div>
            </form>

        </div><!-- sl-mainpanel -->
    </div>
</div>

@endsection
