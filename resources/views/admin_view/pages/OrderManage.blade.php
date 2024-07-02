@extends('admin_view.layouts.layouts')
@extends('admin_view.common.datatableHeader')
@section('container')
    <div class="content-page">
        <div class="content"> &nbsp;
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <br>
                                            <div class="card-body">
                                                <section class="content">
                                                    <table id="example" class="display"
                                                           style="width:100%">
                                                        <thead>
                                                        <tr>
                                                            <th>OrdeID</th>
                                                            <th>Reciver Name</th>
                                                            <th>Phone No</th>
                                                            <th>Address</th>
                                                            <th>Total Price</th>
                                                            <th>Order Date</th>

                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript" language="javascript">
                let table = $('#example').DataTable({
                    ajax: {
                        url: "{{url('/order_details')}}",
                    },
                    searching: true,
                    scrollX: true,
                    scrollY: true,
                    language: {
                        decimal: ',',
                        thousands: '.'
                    },
                    "columns": [
                        {data: "orderid"},
                        {data: "receiver_name"},
                        {data: "phone_number"},
                        {data: "address"},
                        {data: "total_price"},
                        {data: "created_at"},
                    ],
                });


            </script>


            <script>
                $('#example tbody').on('click', 'button.delete-button', function () {
                    if (confirm("Are you sure you want to delete this image?")) {
                        const id = $(this).data('id');
                        // Send an AJAX request to delete the image
                        $.ajax({
                            url: '/delete_member_profile/' + id,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (data) {
                                if (data.message === 'successful') {
                                    window.location.href = data.url;
                                }
                            },
                            error: function (err) {
                                console.error(err);
                            }
                        });
                    }
                });

            </script>
        </div> <!-- end col -->
    </div>
@endsection
