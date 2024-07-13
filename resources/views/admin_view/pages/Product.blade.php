<!-- Include SweetAlert2 CSS -->
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
                    <h4 class="card-title">Product Management</h4>
                </div>
                <div class="card-body">
                    <p class="demo">
                        <a class="btn btn-primary btn-border btn-round" href="{{route('product_mange')}}">
                            Add New Product
                        </a>
                    </p>
                </div>
            </div>
        </div>
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
                            style="width: 100%;"
                        >
                            <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Category ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>SKU</th>
                                <th>Status</th>
                                <th>Date</th>
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
    <script>
        $(document).ready(function () {
            var table = $("#order-details-datatables").DataTable({
                "processing": true,
                "serverSide": true,
                "scrollX": true,
                "scrollY": true,
                "columnDefs": [
                    { targets: [2,6], className:'dt-right' },
                    { targets: [0,1,2,3,4,5,6,7], className:'dt-head-center' },
                    { targets: [0], wrap: true }
                ],

                "ajax": "{{ route('product_list') }}",
                "columns": [
                    { "data": "ProductID" },
                    { "data": "CategoryID" },
                    { "data": "Name" },
                    { "data": "Description" },
                    { "data": "Price" },
                    { "data": "Stock" },
                    { "data": "SKU" },
                    {
                        data: null,
                        render: function(data, type, row) {
                            var status = parseInt(row.status);
                            var id = parseInt(data.ProductID);
                            var buttonClass = status === 1 ? 'btn-success' : 'btn-danger';
                            var buttonText = status === 1 ? 'Active' : 'Deactive';
                            return `<button type="button" data-id="${id}" class="btn ${buttonClass} status-button">${buttonText}</button>`;
                        }
                    },
                    {
                        data: "Created_at",
                        render: function (data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                return moment(data).format('YYYY-MM-DD HH:mm:ss');
                            }
                            return data;
                        }
                    },
                    {
                        data: null,
                        render: function (data, type, row) {
                            var id = parseInt(data.ProductID);
                            return `<button type="button" data-id="${id}" class="btn btn-danger delete-button"><i class="icon-trash" style="font-size:30px;"></i></button>`
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
                                table.ajax.reload();
                            },
                            error: function(xhr, status, error) {
                                // Handle error response if needed
                                console.error(error);
                            }
                        });
                    }
                });
            });

            // Handle click event for status buttons
            $('#order-details-datatables tbody').on('click', 'button.status-button', function() {
                var button = this;

                let data = table.row($(this).closest('tr')).data();
                let status = parseInt(data.status);
                let id = data.ProductID;

                status = status === 1 ? 0 : 1;

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const params = {
                    id: id,
                    status: status,
                };
                const formData = new URLSearchParams(params);
                let url = '/manage_product_status';

                fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                }).then(response => response.json()) // Parse the JSON response
                    .then(data => {
                        let message = data.message;
                        if (message === 'successful') {
                            table.ajax.reload(); // Refresh DataTable after status update
                        } else {
                            // Handle the error case if needed
                            Swal.fire({
                                title: 'Error',
                                text: message,
                                icon: 'error'
                            });
                        }
                    }).catch((err) => {
                    console.error(err);
                    Swal.fire({
                        title: 'Error',
                        text: 'An error occurred while updating the status.',
                        icon: 'error'
                    });
                });
            });


            $('#order-details-datatables tbody').on('click', 'button.delete-button', function () {
                if (confirm("Are you sure you want to delete this image?")) {
                    const id = $(this).data('id');
                    // Send an AJAX request to delete the image
                    $.ajax({
                        url: '/delete_producct/' + id,
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
        });
    </script>
@endsection
