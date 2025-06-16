@extends('member.layout.app')

@push('css')

@endpush

@section('content')


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Strikers Club, Inc.</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Transaction List</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <div class="col-md-12">
                            <!-- TABLE: LATEST ORDERS -->
                            <div class="card">
                                <div class="card-header border-transparent">
                                    <h3 class="card-title">Transaction List</h3>
                                    <div class="card-tools">
                                        {{-- <a href="{{ route('admin.designation.create') }}" class="btn btn-sm btn-info float-left" id="createMember">Add New
                                            Designation</a> --}}
                                        {{--<button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>--}}
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        <table id="contact_table" class="table m-0 invoice-table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    {{-- <th class="text-center"> <input type="checkbox"
                                                        id="check" /></th> --}}
                                                        <th>SL</th>
                                                        <th>Transaction ID</th>
                                                        <th>Date</th>
                                                        <th>Details</th>
                                                        <th>Method</th>
                                                        {{-- <th>Balance</th> --}}
                                                        <th>Amount</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="color:black"></tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>

                    </div>
                    <!-- /.row -->
                </div><!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

            {{-- create  modal --}}
          <div class="modal fade" id="modal-create">
            <div class="modal-dialog">
              <div class="modal-content bg-secondary">
                <div class="modal-header">
                  <h4 class="modal-title">Create Designation</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form  id="createMemberForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body" id="create_modal_body">
                        {{-- create modal show here   --}}

                    </div>
                    <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-light" id="submitBtn">Save</button>
                    </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>



            {{-- edit  modal --}}
          <div class="modal fade" id="modal-edit">
            <div class="modal-dialog">
              <div class="modal-content bg-secondary">
                <div class="modal-header">
                  <h4 class="modal-title">Edit Member</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form  id="editMemberForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body" id="edit_modal_body">
                        {{-- create modal show here   --}}

                    </div>
                    <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-light" id="editBtn">Submit</button>
                    </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>


            {{-- view modal --}}
          <div class="modal fade" id="modal-member_view">
            <div class="modal-dialog">
              <div class="modal-content bg-secondary">
                <div class="modal-header">
                  <h4 class="modal-title">View Member</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="view_modal_body">
                    {{-- View modal show here   --}}

                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-outline-light" data-dismiss="modal">Ok</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>

        <!-- Delete Form -->
        <form id="delete_form" action="" method="post">
            @method('DELETE')
            @csrf
        </form>
@endsection

@push('js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

$(document).ready(function() {
    $(function() {
        var table = $('.invoice-table').DataTable({
            dom: "lBfrtip",
            buttons: [{
                extend: 'pdf',
                text: '<i class="fa-thin fa-file-pdf fa-2x"></i><br>PDF',
                className: 'pdf btn text-white btn-sm px-1',
                exportOptions: {
                    columns: [2, 4, 5, 6, 7, 8]
                }
            }, {
                extend: 'excel',
                text: '<i class="fa-thin fa-file-excel fa-2x"></i><br>Excel',
                className: 'pdf btn text-white btn-sm px-1',
                exportOptions: {
                    columns: [2, 4, 5, 6, 7, 8]
                }
            }, {
                extend: 'print',
                text: '<i class="fa-thin fa-print fa-2x"></i><br>Print',
                className: 'pdf btn text-white btn-sm px-1',
                exportOptions: {
                    columns: [2, 4, 5, 6, 7, 8]
                }
            }, ],

            "pageLength": 50,
            "lengthMenu": [
                [10, 25, 50, 100, 500, 1000, -1],
                [10, 25, 50, 100, 500, 1000, "All"]
            ],
            processing: true,
            serverSide: true,
            searchable: true,
            "ajax": {
                "url": "{{ route('member.invoice.list') }}",
                "data": function(data) {
                    //filter options
                    // data.hrm_department_id = $('#hrm_department_id').val();
                    // data.shift_id = $('#shift_id').val();
                    // data.grade_id = $('#grade_id').val();
                    // data.designation_id = $('#designation_id').val();
                    // data.date_range = $('.submitable_input').val();
                    // data.employment_status = $('#employment_status').val();
                }
            },

                "drawCallback": function(settings) {
                    // Get DataTables API instance
                    var api = new $.fn.dataTable.Api(settings);

                    // Iterate through each row and add class based on 'status'
                    api.rows().every(function(index, element) {
                        var status = this.data().is_read;
                        if (status == 0) {
                            $(this.node()).addClass('bg-warning');
                        }
                    });

                    // Additional code as needed
                    $('#is_check_all').prop('checked', false);

                // // $('#all_item').text('All (' + allRow + ')');
                // $('#is_check_all').prop('checked', false);
                // // $('#trashed_item').text('');
                // // $('#trash_separator').text('');
                // // $("#bulk_action_field option:selected").prop("selected", false);
                },

            columns: [
                // {
                //     name: 'check',
                //     data: 'check',
                //     sWidth: '3%',
                //     orderable: false,
                //     targets: 0
                // },
                {
                    name: 'DT_RowIndex',
                    data: 'DT_RowIndex',
                    sWidth: '3%'
                },
                {
                    data: 'payment_id',
                    name: 'payment_id',
                    sWidth: '10%'
                },
                {
                    data: 'date',
                    name: 'date',
                    sWidth: '10%'
                },
                {
                    data: 'details',
                    name: 'details',
                },
                {
                    data: 'method',
                    name: 'method',
                },
                // {
                //     data: 'total',
                //     name: 'total',
                // },
                {
                    data: 'amount',
                    name: 'amount',
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },

            ],
            "lengthMenu": [
                [10, 25, 50, 100, 500, 1000, -1],
                [10, 25, 50, 100, 500, 1000, "All"]
            ],
        });

        // table.buttons().container().appendTo('#exportButtonsContainer');

        $(document.body).on('click', '#is_check_all', function(event) {
            alert('Checkbox clicked!');
            var checked = event.target.checked;
            if (true == checked) {
                $('.check1').prop('checked', true);
            }
            if (false == checked) {
                $('.check1').prop('checked', false);
            }
        });

        $('#is_check_all').parent().addClass('text-center');

        $(document.body).on('click', '.check1', function(event) {

            var allItem = $('.check1');

            var array = $.map(allItem, function(el, index) {
                return [el]
            })

            var allChecked = array.every(isSameAnswer);

            function isSameAnswer(el, index, arr) {
                if (index === 0) {
                    return true;
                } else {
                    return (el.checked === arr[index - 1].checked);
                }
            }

            if (allChecked && array[0].checked) {
                $('#is_check_all').prop('checked', true);
            } else {
                $('#is_check_all').prop('checked', false);
            }
        });

        //Submit filter form by select input changing
        $(document).on('change', '.submitable', function() {

            table.ajax.reload();

        });


    });

});

$(document).on('click', '#createMember', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');

    $.ajax({
        type: 'get',
        url: url,
        success: function (response) {
            $('#create_modal_body').html(response);
            $('#modal-create').modal('show');
            $('.invoice-table').DataTable().draw(false);
        },
        error: function (error) {
        }
    });
});

$(document).on('click', '#submitBtn', function () {
    var formData = new FormData($('#createMemberForm')[0]);

    $.ajax({
        type: 'post',
        url: "{{ route('admin.designation.store') }}",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            $('#modal-create').modal('hide');
            $('.invoice-table').DataTable().draw(false);
            $('#createMemberForm')[0].reset();

            toastr.success(response.success);
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                // Validation errors occurred
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';

                for (var key in errors) {
                    errorMessage += errors[key][0] + '<br>';
                }

                toastr.error(errorMessage);
            } else {
                toastr.error('An error occurred while processing the request.');
                console.log(xhr);
            }
        }
    });
});

// kasdhkas hasdhasdkasdkas ajskdjaskdjkasdkasjdkjsdkjasdk kasdjksaj dkasjdka sj
$(document).on('click', '#edit', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');

    $.ajax({
        type: 'get',
        url: url,
        success: function (response) {
            $('#edit_modal_body').html(response);
            $('#modal-edit').modal('show');
            $('.invoice-table').DataTable().draw(false);
        },
        error: function (error) {
        }
    });
});

$(document).on('click', '#editBtn', function () {
    var formData = new FormData($('#editMemberForm')[0]);
    var memberId = $('#member_id').val();

    $.ajax({
        type: 'post',
        url: "{{ route('admin.designation.update',"+memberId+") }}",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            $('#modal-edit').modal('hide');
            $('.invoice-table').DataTable().draw(false);
            $('#editMemberForm')[0].reset();

            toastr.success(response.success);
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                // Validation errors occurred
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';

                for (var key in errors) {
                    errorMessage += errors[key][0] + '<br>';
                }

                toastr.error(errorMessage);
            } else {
                toastr.error('An error occurred while processing the request.');
                console.log(xhr);
            }
        }
    });
});
// fkhskdfsdf ksdf sdfksdfkjs kjsdkfjdkfjsdkfjdk

$(document).on('click', '#view', function (e) {
    e.preventDefault();

    var url = $(this).attr('href');

    $.ajax({
        type: 'get',
        url: url,
        success: function (response) {
            $('#view_modal_body').html(response);
            $('#modal-member_view').modal('show');
            $('.invoice-table').DataTable().draw(false);
            // Handle success response
        },
        error: function (error) {
            // Handle error response
        }
    });
});
$(document).on('click', '#delete', function (e) {
    e.preventDefault();

    var url = $(this).attr('href');
    $('#delete_form').attr('action', url);


    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
            // $("#delete_form").submit();

            // Swal.fire({
            // title: "Deleted!",
            // text: "Your file has been deleted.",
            // icon: "success"
            // });

            // alert(url);
            $.ajax({
                type: 'DELETE',
                url: url,
                success: function (response) {
                    toastr.success(response.success);
                    $('.invoice-table').DataTable().draw(false);
                    console.log(response);
                    // Handle success response
                },
                error: function (error) {
                    // Handle error response
                }
            });
        }
    });
});
</script>
@endpush
