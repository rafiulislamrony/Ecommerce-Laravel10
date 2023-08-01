@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Subscriber Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Subscriber List
                <a href="#" class="btn btn-sm btn-primary" style="float: right" data-toggle="modal"
                    data-target="#modaldemo3" id="btnAllDelete">All Delete</a>
            </h6>
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <!-- ... (remaining table structure) ... -->
                    <tbody>
                        @foreach ($sub as $key => $row)
                        <tr>
                            <td><input type="checkbox" class="subscriber-checkbox" value="{{ $row->id }}"> {{ $key + 1
                                }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ \Carbon\Carbon::parse($row->created_at)->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('subscriber.delete', $row->id) }}" class="btn btn-sm btn-danger delete-btn"
                                    data-delete-url="{{ route('subscriber.delete', $row->id) }}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- card -->
    </div> <!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
</div>

<form id="formAllDelete" action="{{ route('delete.subscribers') }}" method="POST">
    @csrf
    <input type="hidden" id="selectedSubscriberIds" name="ids">
</form>

<script>
    // JavaScript for handling All Delete button click
    document.getElementById('btnAllDelete').addEventListener('click', function(e) {
        e.preventDefault();
        const checkedIds = Array.from(document.getElementsByClassName('subscriber-checkbox'))
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);

        if (checkedIds.length === 0) {
            toastr.warning('Please select at least one subscriber to delete.');
            return;
        }

        swal({
            title: "Are you sure?",
            text: "Once deleted, this will be permanently deleted!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                document.getElementById('selectedSubscriberIds').value = JSON.stringify(checkedIds);
                document.getElementById('formAllDelete').submit();
            } else {
                swal("Safe Data!");
            }
        });
    });

    // JavaScript for handling delete confirmation with SweetAlert
    $(document).on("click", ".delete-btn", function(e) {
        e.preventDefault();
        var link = $(this).data("delete-url");
        swal({
            title: "Are you sure?",
            text: "Once deleted, this will be permanently deleted!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                window.location.href = link;
            } else {
                swal("Safe Data!");
            }
        });
    });
</script> 

@endsection
