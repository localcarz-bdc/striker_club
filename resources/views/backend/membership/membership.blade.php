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
                            <h1 class="m-0">Strikers Club, Inc. Membership</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Membership Application List</li>
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
                                    <h3 class="card-title">Membership Application List</h3>
                                    <div class="card-tools">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-info float-left newMember" id="newMember">Add New
                                            Membership</a>
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
                                        <table id="contact_table" class="table m-0 contact-table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> <input type="checkbox"
                                                        id="check" /></th>
                                                    <th>SN.</th>
                                                    <th>Name</th>
                                                    <th>Telephone</th>
                                                    <th>Email</th>
                                                    <th>Date & Time</th>
                                                    <th>Is Approve</th>
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
          <div class="modal fade" id="modal-create" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered " role="document">
              <div class="modal-content bg-secondary">
                <div class="modal-header">
                  <h4 class="modal-title">Create Membership Application</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <form  id="createMemberForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body" id="new_modal_body">
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

            {{-- Edit  modal --}}
          <div class="modal fade" id="modal-edit">
            <div class="modal-dialog">
              <div class="modal-content bg-secondary">
                <div class="modal-header">
                  <h4 class="modal-title">Edit Membership Application</h4>
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
                    <button type="button" class="btn btn-outline-light" id="ediSubmitBtn">Update</button>
                    </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>


            {{-- create view modal --}}
          <div class="modal fade" id="modal-create_view">
            <div class="modal-dialog">
              <div class="modal-content bg-secondary">
                <div class="modal-header">
                  <h4 class="modal-title">Membership Application Details</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="view_modal_body">
                    {{-- view modal show here   --}}

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
    $('[data-mask]').inputmask()
    $(function() {
        var table = $('.contact-table').DataTable({
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
                "url": "{{ route('admin.member.index') }}",
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
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'telephone',
                    name: 'telephone'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'is_approve',
                    name: 'is_approve'
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

        table.buttons().container().appendTo('#exportButtonsContainer');

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

$(document).on('click', '#newMember', function (e) {
    e.preventDefault();


    var url = "{{ route('admin.member.create') }}";
    $.ajax({
        type: 'get',
        url: url,
        success: function (response) {
            $('#new_modal_body').html(response);
            $('#modal-create').modal('show');
            $('.contact-table').DataTable().draw(false);
            // Handle success response
        },
        error: function (error) {
            // Handle error response
        }
    });
});
$(document).on('click', '#view', function (e) {
    e.preventDefault();

    var url = $(this).attr('href');

    $.ajax({
        type: 'get',
        url: url,
        success: function (response) {
            $('#view_modal_body').html(response);
            $('#modal-create_view').modal('show');
            $('.contact-table').DataTable().draw(false);
            // Handle success response
        },
        error: function (error) {
            // Handle error response
        }
    });
});

$(document).on('click', '#edit', function (e) {
    e.preventDefault();

    var url = $(this).attr('href');

    $.ajax({
        type: 'get',
        url: url,
        success: function (response) {
            $('#edit_modal_body').html(response);
            $('#modal-edit').modal('show');
            $('.contact-table').DataTable().draw(false);
            // Handle success response
        },
        error: function (error) {
            // Handle error response
        }
    });
});



$(document).on('change', '.is_approve', function (e) {
    e.preventDefault();
    const isApproveValue =   $(this).data('isapproveid');
    console.log('Original isApproveValue:', isApproveValue);

    const url = `{{ route('admin.member.is_approve', ':isApproveValue') }}`;
    const finalUrl = url.replace(':isApproveValue', isApproveValue);

    var value = $(this).val();

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
            if (value == 1) {
                // Show SweetAlert with two input fields
                Swal.fire({
                    title: 'Payment Info',
                    html: `
                            <p>Total Balance: $ 0 &nbsp;&nbsp;&nbsp; Current Balance: $ 0 &nbsp;&nbsp;&nbsp; Due Balance: $ 0</p>
                            <div style="text-align: left;">
                                Total  : <input type="text" id="sweet_total_balance" class="swal2-input" placeholder="Enter Total Balance">
                            </div>
                            <div style="text-align: left;">
                               Current : <input type="text" id="sweet_pay_balance" class="swal2-input" placeholder="Enter Due Balance">
                            </div>
                            <div style="text-align: left;">
                                Type : <select name="type" id="sweet_type" class="swal2-select">
                                    <option value="" disabled>--Select Type--</option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Annually">Annually</option>
                                </select>
                            </div>
                        `,
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        var total_balance = $('#sweet_total_balance').val();
                        var pay_balance = $('#sweet_pay_balance').val();
                        var type = $('#sweet_type').val();

                        // Now you can use input1Value and input2Value as needed
                        // Make an AJAX request or perform any other action
                        $.ajax({
                            type: 'get',
                            url: url,
                            data:{
                                value: value,
                                id: isApproveValue,
                                total_balance:total_balance,
                                pay_balance:pay_balance,
                                type:type
                            },
                            success: function (response) {
                                $('.contact-table').DataTable().draw(false);
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
                    }
                });
            } else {
                // Show default SweetAlert without additional input fields
                $.ajax({
                            type: 'get',
                            url: url,
                            data:{
                                value: value,
                                id: isApproveValue,
                            },
                            success: function (response) {
                                $('.contact-table').DataTable().draw(false);
                                console.log(response.success);
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
            }
        }
    });
});



// $(document).on('change', '.is_approve', function (e) {
//     e.preventDefault();
//     const isApproveValue =   $(this).data('isapproveid');
//     console.log('Original isApproveValue:', isApproveValue);

//     const url = `{{ route('admin.member.is_approve', ':isApproveValue') }}`;
//     const finalUrl = url.replace(':isApproveValue', isApproveValue);
//     // var isApproveValue = $('#is_approve').data('isapproveid');
//     // var url = "{{ route('admin.debutante.is_approve', ':isApproveValue') }}";
//     //     url = url.replace(':isApproveValue', isApproveValue);
//     var value = $(this).val();
//     // alert(isApproveValue);
//     // console.log('Final URL:', finalUrl + ' ok ' +value);


//     Swal.fire({
//         title: "Are you sure?",
//         text: "You won't be able to revert this!",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//         cancelButtonColor: "#d33",
//         confirmButtonText: "Yes, change it!",
//         reverseButtons: true
//         }).then((result) => {
//         if (result.isConfirmed) {
//             // $("#delete_form").submit();

//             // Swal.fire({
//             // title: "Deleted!",
//             // text: "Your file has been deleted.",
//             // icon: "success"
//             // });

//             $.ajax({
//                 type: 'get',
//                 url: url,
//                 data:{
//                     value:value,
//                     id:isApproveValue,
//                 },
//                 success: function (response) {
//                     // $('#edit_modal_body').html(response);
//                     // $('#modal-create_view').modal('show');
//                     $('.contact-table').DataTable().draw(false);
//                     toastr.success(response.success);
//                     // Handle success response
//                 },
//                 error: function (error) {
//                     toastr.error(error.error);
//                     // Handle error response
//                 }
//             });
//         }
//     });
// });


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
                    $('.contact-table').DataTable().draw(false);
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
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function(){
        $('[data-mask]').inputmask()

        $(document).on('click','#submitBtn',function(e){
            e.preventDefault();
                var formData = $('#createMemberForm').serialize();
                $.ajax({
                    type: 'post',
                    url : "{{ route('admin.member.store') }}",
                    data : formData,
                    success: function(response){
                        toastr.success(response.success);
                        $('#createMemberForm')[0].reset();
                        $('#modal-create').modal('hide');
                        $('.contact-table').DataTable().draw(false);
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
    });
</script>
<script>
    $(document).ready(function() {
      $(document).on('change', '#dob', function() {
        var birthDate = $(this).val();

        // Check if a birthdate is selected
        if (birthDate) {
          // Calculate age
          var today = new Date();
          var birthdateObj = new Date(birthDate); // Corrected variable name
          var age = today.getFullYear() - birthdateObj.getFullYear();

          // Check if birthday has occurred this year
          if (
            today.getMonth() < birthdateObj.getMonth() ||
            (today.getMonth() === birthdateObj.getMonth() && today.getDate() < birthdateObj.getDate())
          ) {
            age--;
          }

          // Display the result (assuming there is an input field with the ID "calculateAge")
          $("#calculateAge").val(age);
        } else {
          // Display an error message if no birthdate is selected
          $("#result").html("Please enter your birthdate.");
        }
      });
    });
  </script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function(){
        $('[data-mask]').inputmask()

        $(document).on('click','#ediSubmitBtn',function(e){
            e.preventDefault();
                var formData = $('#editMemberForm').serialize();
                $.ajax({
                    type: 'post',
                    url : "{{ route('admin.member.update') }}",
                    data : formData,
                    success: function(response){
                        toastr.success(response.success);
                        $('#editMemberForm')[0].reset();
                        $('#modal-edit').modal('hide');
                        $('.contact-table').DataTable().draw(false);
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
    });
</script>
<script>
    $(document).ready(function() {
      $(document).on('change', '#editDob', function() {
        var birthDate = $(this).val();

        // Check if a birthdate is selected
        if (birthDate) {
          // Calculate age
          var today = new Date();
          var birthdateObj = new Date(birthDate); // Corrected variable name
          var age = today.getFullYear() - birthdateObj.getFullYear();

          // Check if birthday has occurred this year
          if (
            today.getMonth() < birthdateObj.getMonth() ||
            (today.getMonth() === birthdateObj.getMonth() && today.getDate() < birthdateObj.getDate())
          ) {
            age--;
          }

          // Display the result (assuming there is an input field with the ID "calculateAge")
          $("#editCalculateAge").val(age);
        } else {
          // Display an error message if no birthdate is selected
          $("#result").html("Please enter your birthdate.");
        }
      });
    });
  </script>
@endpush
