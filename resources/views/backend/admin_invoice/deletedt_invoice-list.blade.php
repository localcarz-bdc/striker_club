@extends('backend.layout.app')

@section('content')
<div class="content-wrapper">
    <div class=" row">
        <div class="col-md-12">
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Invoice</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table class="table m-0 table-bordered invoice_table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Invoice_no</th>
                                    <th>Type</th>
                                    <th>Total</th>
                                    <th>Payment method</th>
                                    <th>Payment date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="color:black">

                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card-body -->

                <!-- /.card -->

            </section>

        </div>
    </div>
</div>

<!-- Delete Form -->
<form id="delete_form" action="" method="post">
    @method('DELETE')
    @csrf
</form>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(function() {

                var table = $('.invoice_table').DataTable({

                    dom: "lBfrtip",
                    buttons: ["copy", "csv", "excel", "pdf", "print"],

                    pageLength: 25,
                    processing: true,
                    serverSide: true,
                    searchable: true,
                    "ajax": {
                        "url": "{{ route('member.invoice.list') }}",
                        "datatype": "json",
                        "dataSrc": "data",
                        "data": function(data) {

                        }
                    },

                    drawCallback: function(settings) {

                        $('#is_check_all').prop('checked', false);

                    },

                    columns: [{
                            name: 'DT_RowIndex',
                            data: 'DT_RowIndex',
                            sWidth: '3%'
                        },

                        {
                            data: 'invoice_id',
                            name: 'invoice_id',
                            sWidth: '10%'
                        },
                        {
                            data: 'type',
                            name: 'type',

                        },
                        {
                            data: 'total',
                            name: 'total',

                        },
                        {
                            data: 'Payment method',
                            name: 'Payment method',

                        },
                        {
                            data: 'Payment date',
                            name: 'Payment date',

                        },


                        {
                            data: 'action',
                            name: 'action',
                            sWidth: "15%",
                            orderable: false,
                            searchable: false
                        },

                    ],
                    lengthMenu: [
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

            $(document).on('click','.delete_two', function(){
                var id = @json(auth()->user()->id);
                var url = `{{ route('member.invoice.new.delete', '') }}/${id}`;
                // alert(id + ' u ' + url)
                $.ajax({
                url: url,
                method: 'DELETE',
                dataType: 'json',
                data: { },
                success: function(response) {
                    // Handle the response from the server
                    if (response.status == 'success') {

                        toastr.success("Invoice delete successfully");
                        window.location.href = "{{ route('member.invoice.list') }}";
                    }
                },
            });
            })

            $(document).on('click', '#delete', function (e) {
                e.preventDefault();

                var url = $(this).attr('href');
                alert(url)
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
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for Laravel
                            },
                            success: function (response) {
                                $('.invoice_table').DataTable().draw(false);
                                toastr.success(response.success);
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
        });
    </script>
@endpush
