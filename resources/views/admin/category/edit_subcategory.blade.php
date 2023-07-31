@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Sub Category Update</h5>

        </div><!-- sl-page-title -->
        <div class="row ">
            <div class="col-md-8">
                <div class="card pd-20 pd-sm-40">
                    <div class="table-wrapper">
                        <form action="{{ route('subcategory.update', $subcategory->id) }}" method="post">
                            @csrf
                            <div class="modal-body pd-20">
                                <div class="form-group">
                                    <label for="text1">Category Name</label>
                                     <select name="category_id" class="form-control" id="">

                                        @foreach ($category as $row)
                                        <option value="{{ $row->id }}"
                                            <?php if ($row->id == $subcategory->category_id) {
                                                echo "selected"; } ?> >{{ $row->category_name }}</option>

                                        @endforeach
                                     </select>
                                </div>
                                <div class="form-group">
                                    <label for="text1">Sub Category Name</label>
                                    <input type="text" class="form-control" id="text1" name="subcategory_name"
                                        value="{{ $subcategory->subcategory_name }}">
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
