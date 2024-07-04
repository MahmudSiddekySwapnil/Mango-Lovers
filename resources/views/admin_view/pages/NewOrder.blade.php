<!-- Include SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">

@extends('admin_view.layouts.layouts')
@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">New Product Orders</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="#">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Tables</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Datatables</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order Details</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table
                            id="order-details-datatables"
                            class="display table table-striped table-hover"
                        >
                            <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Product Name</th>
                                <th>Address</th>
                                <th>District</th>
                                <th>City</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Order Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#order-details-datatables").DataTable({
                "processing": true,
                "serverSide": true,
                "scrollX": true,
                "scrollY": true,
                "columnDefs": [
                    { targets: [2,6], className:'dt-right' },
                    { targets: [0,1,2,3,4,5,6,7], className:'dt-head-center' }
                ],
                "ajax": "{{ route('order_details') }}",
                "columns": [
                    { "data": "orderid" },
                    { "data": "receiver_name" },
                    { "data": "phone_number" },
                    { "data": "address" },
                    { "data": "district" },
                    { "data": "city" },
                    { "data": "total_price" },
                    {
                        data: null,
                        render: function (data, type, row) {
                            var status = row.status;
                            let cell_content1 = null;
                            if (status === 0) {
                                cell_content1 = '<button class="btn btn-danger btn-sm" data-order-id="' + row.orderid + '">Old Order</button>';
                            } else {
                                cell_content1 = '<button class="btn btn-primary btn-sm update-status-btn" data-order-id="' + row.orderid + '">New Order</button>';
                            }
                            return cell_content1;
                        }
                    },
                    {
                        data: "created_at",
                        render: function (data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                return moment(data).format('YYYY-MM-DD HH:mm:ss');
                            }
                            return data;
                        }
                    },
                    {
                        "data": null,
                        render: function (data, type, row) {
                            var loanId = row.orderid;
                            let orderID = null;
                            if (loanId !== null) {
                                orderID = `<a href="download_invoice/${loanId}"><i class="fa fa-file-pdf-o" style="font-size:24px"></i></a>`;
                            }
                            return orderID;
                        }

                    },
                ],
                "order": [[7, "desc"]], // Sort by the status column initially
            });

            // Handle click event for update status buttons
            $('#order-details-datatables').on('click', '.update-status-btn', function() {
                var orderId = $(this).data('order-id');

                // Confirmation dialog with SweetAlert2
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to update the order status.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var url = "{{ route('update.order.status', ':id') }}";
                        url = url.replace(':id', orderId);

                        $.ajax({
                            url: url,
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                // Handle success response if needed
                                console.log(response);
                                // Refresh DataTable after status update
                                $('#order-details-datatables').DataTable().ajax.reload();
                            },
                            error: function(xhr, status, error) {
                                // Handle error response if needed
                                console.error(error);
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
