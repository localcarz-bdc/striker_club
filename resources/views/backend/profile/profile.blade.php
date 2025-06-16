@extends('backend.layout.app')

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
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Member</li>
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
                                <h3 class="card-title">Members List</h3>
                                <div class="card-tools">
                                    {{-- <a href="{{ route('admin.profile.reset') }}" class="btn btn-sm btn-info float-left" id="createMember">Reset Password 2</a> --}}
                                    {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i> --}}
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table id="contact_table" class="table m-0 member-table table-bordered"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center"> <input type="checkbox" id="check" /></th>
                                                <th>SN.</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Designation</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody style="color:black"></tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.card-body -->
                            {{-- <div class="card-footer clearfix">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New
                                        Order</a>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All
                                        Orders</a>
                                </div> --}}
                            <!-- /.card-footer -->
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
                    <h4 class="modal-title">Reset Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="createMemberForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body" id="create_modal_body">
                        {{-- create modal show here   --}}

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline-light" id="submitBtn">Submit</button>
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
                    <h4 class="modal-title">Edit Profile</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editMemberForm" method="post" enctype="multipart/form-data">
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
                    <h4 class="modal-title">View Profile</h4>
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

    {{-- reset modal --}}
    <div class="modal fade" id="modal-member_reset">
        <div class="modal-dialog">
            <div class="modal-content bg-secondary">
                <div class="modal-header">
                    <h4 class="modal-title">Reset Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="createResetMemberForm" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body" id="reset_modal_body">
                    {{-- View modal show here   --}}

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-light" id="resetsubmitBtn">Ok</button>
                </div>
            </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    {{-- paymant  modal --}}
    <div class="modal fade" id="modal-payment">
        <div class="modal-dialog">
            <div class="modal-content bg-secondary">
                <div class="modal-header">
                    <h4 class="modal-title">Payment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex justify-content-between">
                        <div></div>
                        <div>Membership &nbsp; - ${{ auth()->user()->total_balance }}</div>
                        <div>Last Paid &nbsp; - ${{ auth()->user()->paid_balance }}</div>
                        <div>Balance &nbsp; - ${{ auth()->user()->due_balance }}</div>
                        <div></div>
                    </div>
                    <h6 class="modal-title"> </h6>

                </div>

                <form id="paymentMemberForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body" id="payment_modal_body">
                        {{-- create modal show here   --}}
                    </div>
                    <div class="modal-body">
                        <span id="typeData"></span>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline-light" id="paymentSubmitBtn">Submit</button>
                    </div>
                </form>
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
                var table = $('.member-table').DataTable({
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
                        "url": "{{ route('admin.profile.index') }}",
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

                    columns: [{
                            name: 'check',
                            data: 'check',
                            sWidth: '3%',
                            orderable: false,
                            targets: 0
                        },
                        {
                            name: 'DT_RowIndex',
                            data: 'DT_RowIndex',
                            sWidth: '3%'
                        },
                        {
                            data: 'img',
                            name: 'img'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'designation',
                            name: 'designation'
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

        $(document).on('click', '#createMember', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');

            $.ajax({
                type: 'get',
                url: url,
                success: function(response) {
                    $('#create_modal_body').html(response);
                    $('#modal-create').modal('show');
                    $('.member-table').DataTable().draw(false);
                },
                error: function(error) {}
            });
        });

        $(document).on('click', '#submitBtn', function() {
            var formData = new FormData($('#createMemberForm')[0]);

            $.ajax({
                type: 'post',
                url: "{{ route('admin.profile.reset.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#modal-create').modal('hide');
                    $('.member-table').DataTable().draw(false);
                    $('#createMemberForm')[0].reset();

                    toastr.success(response.success);
                },
                error: function(xhr) {
                    console.log(xhr)
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
                    toastr.error(errorMessage);
                }
            });
        });

        $(document).on('click', '#resetsubmitBtn', function() {
            var formData = new FormData($('#createResetMemberForm')[0]);

            $.ajax({
                type: 'post',
                url: "{{ route('admin.profile.reset.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('.member-table').DataTable().draw(false);
                    $('#createResetMemberForm')[0].reset();
                    $('#reset_modal_body').modal('hide');

                    toastr.success(response.success);
                },
                error: function(xhr) {
                    console.log(xhr)
                    if (xhr.status === 422) {
                // Validation or other errors occurred
                        var errors = xhr.responseJSON.errors || xhr.responseJSON.error;
                        var errorMessage = '';

                        if (typeof errors === 'object') {
                            // Validation errors
                            for (var key in errors) {
                                errorMessage += errors[key][0] + '<br>';
                            }
                        } else {
                            // Other error messages
                            errorMessage = errors;
                        }

                        toastr.error(errorMessage);
                    } else if (xhr.status === 403) {
                        toastr.error('User is not authenticated.');
                    } else {
                        toastr.error('An error occurred while processing the request.');
                    }
                }
            });
        });




        // kasdhkas hasdhasdkasdkas ajskdjaskdjkasdkasjdkjsdkjasdk kasdjksaj dkasjdka sj
        $(document).on('click', '#edit', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');

            $.ajax({
                type: 'get',
                url: url,
                success: function(response) {
                    $('#edit_modal_body').html(response);
                    $('#modal-edit').modal('show');
                    $('.member-table').DataTable().draw(false);
                },
                error: function(error) {}
            });
        });

        $(document).on('click', '#editBtn', function() {
            var formData = new FormData($('#editMemberForm')[0]);
            var memberId = $('#member_id').val();

            $.ajax({
                type: 'post',
                url: "{{ route('admin.membersData.update', '+memberId+') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#modal-edit').modal('hide');
                    $('.member-table').DataTable().draw(false);
                    $('#editMemberForm')[0].reset();

                    toastr.success(response.success);
                },
                error: function(xhr) {
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

        $(document).on('click', '#view', function(e) {
            e.preventDefault();

            var url = $(this).attr('href');

            $.ajax({
                type: 'get',
                url: url,
                success: function(response) {
                    $('#view_modal_body').html(response);
                    $('#modal-member_view').modal('show');
                    $('.member-table').DataTable().draw(false);
                    // Handle success response
                },
                error: function(error) {
                    // Handle error response
                }
            });
        });
        // fkhskdfsdf ksdf sdfksdfkjs kjsdkfjdkfjsdkfjdk

        $(document).on('click', '#reset', function(e) {
            e.preventDefault();

            var url = $(this).attr('href');

            $.ajax({
                type: 'get',
                url: url,
                success: function(response) {
                    $('#reset_modal_body').html(response);
                    $('#modal-member_reset').modal('show');
                    $('.member-table').DataTable().draw(false);
                    // Handle success response
                },
                error: function(error) {
                    // Handle error response
                }
            });
        });
        $(document).on('change', '#approveDesignation', function(e) {
            e.preventDefault();
            var designation = $(this).val();
            var designationId = $(this).closest('tr').find('.designationId').val();

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, change it!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'get',
                        url: "", // Corrected syntax with quotes
                        data: {
                            designation: designation,
                            designationId: designationId,
                        },
                        success: function(response) {
                            toastr.success(response.success);
                            $('.member-table').DataTable().draw(false);
                        },
                        error: function(error) {
                            // Handle error response
                        }
                    });
                }
            });

        });


        $(document).on('click', '#delete', function(e) {
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
                        success: function(response) {
                            toastr.success(response.success);
                            $('.member-table').DataTable().draw(false);
                            console.log(response);
                            // Handle success response
                        },
                        error: function(error) {
                            // Handle error response
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '#makepayment', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.ajax({
                type: 'get',
                url: url,
                success: function(response) {
                    $('#payment_modal_body').html(response);
                    $('#modal-payment').modal('show');
                    $('.member-table').DataTable().draw(false);
                },
                error: function(error) {}
            });
        });

        $(document).on('change', '#paymentType', function(e) {
            e.preventDefault();

            var data = $(this).val();
            var action = $(this).find('option:selected').data('info');
            var payment = $('#fullPaymentPrice').val();
            // alert(action+ ' p '+payment + 'q '+ data)
            if (data == 'full') {
                $('#typeData').html('Your full payable amount is $' + payment);
            }
            if (data == 'custom') {
                $('#typeData').html(
                    '<input name="customInput" id="customInput" class="form-control" placeholder="Enter Partial Amount">'
                ); // Added name attribute
            }
        });
    </script>
@endpush
