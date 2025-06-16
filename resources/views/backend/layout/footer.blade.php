        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>&copy; 2024 <a href="#">Strikers Club Inc.</a></strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 2.0.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{asset('backend')}}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{asset('backend')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('backend')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('backend')}}/dist/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{asset('backend')}}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="{{asset('backend')}}/plugins/raphael/raphael.min.js"></script>
    <script src="{{asset('backend')}}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="{{asset('backend')}}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="{{asset('backend')}}/plugins/chart.js/Chart.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('backend')}}/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('backend')}}/dist/js/pages/dashboard2.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/inputmask/jquery.inputmask.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.all.min.js "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- summernote -->

    <script>
        $(function () {
          // Summernote
          $('#summernote').summernote()

          // CodeMirror
          CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            mode: "htmlmixed",
            theme: "monokai"
          });
        })
      </script>

<script>
    $(document).on('click', '#paymentSubmitBtn', function() {
        addCart();
    });
    $(document).on('click', '#individualPaymentSubmitBtn', function() {
        individualAddCart();
    });

    function individualAddCart(){
        // var balance = {{ session('total_balance') }};
        var balance = $('#fullPaymentPrice').val();
//         session('total_balance')
// session('last_paid')
// session('balance')
        var paymentType = $('#paymentType').val()
        var fullPaymentPrice = $('#fullPaymentPrice').val()
        //var fullPaymentPrice = {{ session('total_balance') }}
        var customInput = $('#customInput').val()
        var userId = $('#userId').val()
        var customVal = customInput;
        if (paymentType == 'full') {
            customVal = balance;
        }

        Swal.fire({
            html: `<p>Your total membership due is <strong>$${balance}</strong></p>
                <p>You indicated you would like to pay <strong>$${customVal}</strong></p>
                <p>If that is correct, click yes to continue</p>`,
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    // url: "{{ route('admin.individual.invoice.store',"+userId+") }}",
                    url: `{{ route('admin.individual.invoice.store', ':userId') }}`.replace(':userId', userId),
                    // data: formData,
                    data: {
                        paymentType: paymentType,
                        fullPaymentPrice: fullPaymentPrice,
                        customInput: customInput,
                        userId: userId,
                        userId
                    },
                    // contentType: false,
                    // processData: false,
                    success: function(response) {
                        console.log(response.message);
                        $('#modal-payment').modal('hide');
                        $('.member-table').DataTable().draw(false);
                        $('#paymentMemberForm')[0].reset();
                        toastr.success(response.message, '', {
                            onHidden: function() {
                                // window.location.reload();
                            }
                        });
                        updateCartData();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var response = xhr.responseJSON;
                            toastr.error(response.message);
                        } else {
                            console.log('Unexpected error:', xhr);
                        }
                    }
                });
            }
        });
    }
    function addCart(){
        var balance = @json(auth()->user()->due_balance);

        var paymentType = $('#paymentType').val()
        var fullPaymentPrice = $('#fullPaymentPrice').val()
        var customInput = $('#customInput').val()
        var userId = $('#userId').val()
        var customVal = customInput;
        if (paymentType == 'full') {
            customVal = balance;
        }

        Swal.fire({
            html: `<p>Your total membership due is <strong>$${balance}</strong></p>
                <p>You indicated you would like to pay <strong>$${customVal}</strong></p>
                <p>If that is correct, click yes to continue</p>`,
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: "{{ route('admin.invoice.store') }}",
                    // data: formData,
                    data: {
                        paymentType: paymentType,
                        fullPaymentPrice: fullPaymentPrice,
                        customInput: customInput,
                        userId: userId,
                        userId
                    },
                    // contentType: false,
                    // processData: false,
                    success: function(response) {
                        console.log(response.message);
                        $('#modal-payment').modal('hide');
                        $('.member-table').DataTable().draw(false);
                        $('#paymentMemberForm')[0].reset();
                        toastr.success(response.message, '', {
                            onHidden: function() {
                                // window.location.reload();
                            }
                        });
                        updateCartData();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var response = xhr.responseJSON;
                            toastr.error(response.message);
                        } else {
                            console.log('Unexpected error:', xhr);
                        }
                    }
                });
            }
        });
    }
</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function updateCartData() {
        $.ajax({
            url: "{{ route('admin.get.cart_item') }}",
            method: "GET", // Corrected the method to "GET"
            success: function(res) {
                console.log(res);
                if (res.status === 'success') {
                    var count = res.count;
                    console.log(count);
                    $('#cart-count').text(count);
                    $('#invoice-section').html(res.data); // Use .html() to replace the content
                }
                if (res.count == 0) {
                    $('.checkInvoiceNull').prop('disabled', true);
                }
            },
            error: function(err) {
                console.error(err);
            }
        });
    }

    $(document).ready(function() {
        updateCartData();

    });

    $(document).on('click', '.clearAllBtn', function() {
        $.ajax({
            url: "{{ route('admin.cart.deleteAll') }}", // Updated route name
            method: "post",
            data: {}, // No need to send any specific data for deleting all items
            success: function(res) {
                console.log(res);
                if (res.status == 'success') {
                    toastr.success(res.message, {
                        timeOut: 1000
                    });
                    // Remove all rows from the cart table or update your UI accordingly
                    $('.cart-table tbody tr').remove();
                    updateCartData();
                }
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.deleteCart', function(e) {
            e.preventDefault();
            var clickedButton = $(this);
            var id = clickedButton.data('id');

            $.ajax({
                url: "{{ route('admin.cart.data.delete') }}",
                method: "post",
                data: {
                    id: id
                },
                success: function(res) {
                    if (res.status == 'success') {
                        toastr.success(res.message, {
                            timeOut: 1000
                        });
                        clickedButton.closest('tr').remove();
                        updateCartData();
                    }
                }
            });
        });
    });
</script>
