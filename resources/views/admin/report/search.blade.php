@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Search Report</h5>
        </div><!-- sl-page-title -->
        <div class="row">

            <div class="col-lg-4">
                <div class="card">
                    <form action="{{ route('search.by.date') }}" method="post">
                        @csrf
                        <div class="modal-body pd-20">
                            <div class="form-group">
                                <label for="text1">Search by Date</label>
                                <input type="date" class="form-control" id="text1" name="date">
                            </div>
                        </div><!-- modal-body -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info pd-x-20">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <form action="{{ route('search.by.month') }}" method="post">
                        @csrf
                        <div class="modal-body pd-20">
                            <div class="form-group">
                                <label for="text2">Search by Month</label>
                                <select class="form-control" name="month">
                                    <option value="" disabled selected hidden>--Select Month--</option>
                                    <option value='janaury'>Janaury</option>
                                    <option value='february'>February</option>
                                    <option value='march'>March</option>
                                    <option value='april'>April</option>
                                    <option value='may'>May</option>
                                    <option value='june'>June</option>
                                    <option value='july'>July</option>
                                    <option value='august'>August</option>
                                    <option value='september'>September</option>
                                    <option value='october'>October</option>
                                    <option value='november'>November</option>
                                    <option value='december'>December</option>
                                </select>
                            </div>
                        </div><!-- modal-body -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info pd-x-20">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <form action="{{ route('search.by.year') }}" method="post">
                        @csrf
                        <div class="modal-body pd-20">
                            <div class="form-group">
                                <label for="text3">Search By Year</label>
                                <select class="form-control" id="text3" name="year">
                                    <option value="" disabled selected hidden>--Select Year--</option>
                                    <option value='2018'>2018</option>
                                    <option value='2019'>2019</option>
                                    <option value='2020'>2020</option>
                                    <option value='2021'>2021</option>
                                    <option value='2022'>2022</option>
                                    <option value='2023'>2023</option>
                                    <option value='2024'>2024</option>
                                    <option value='2025'>2025</option>
                                </select>
                            </div>
                        </div><!-- modal-body -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info pd-x-20">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
    @endsection
