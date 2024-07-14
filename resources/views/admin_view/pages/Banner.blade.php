<!-- Include SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
<style>
    .upload-card {
        position: relative;
        display: inline-block;
        margin: 10px;
    }

    .image-preview {
        max-width: 100%;
        height: auto;
    }

    .delete-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: red;
        color: white;
        border: none;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        cursor: pointer;
    }


</style>
@extends('admin_view.layouts.layouts')
@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Banner Manage</h3>
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
                    <h4 class="card-title">Banner Management</h4>
                </div>
                <div class="card-body">
                    <p class="demo">
                        <button type="button" class="btn btn-primary btn-border btn-round" data-toggle="modal" data-target="#exampleModal">
                            Add Banner
                        </button>

                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Banner Details</h4>
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
                                <th>Banner ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
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

    <!-- Include SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script>
        $(document).ready(function() {
            var table = $('#order-details-datatables').DataTable({
                "processing": true,
                "serverSide": true,
                "scrollX": true,
                "scrollY": true,
                "ajax": {
                    "url": "{{ route('banner_data') }}",
                    "type": "GET",
                    "error": function(xhr, error, thrown) {
                        console.log("Error occurred while fetching data: ", error);
                    }
                },
                "columns": [
                    {"data": "BannerID"},
                    {
                        data: "image_url",
                        render: function (data, type, row) {
                            // Assuming "picture" contains the file path of the image
                            return '<img class="image-modal" src="' + data + '" width="150" height="100" />';
                        }
                    },
                    {"data": "Name"},
                    {"data": "Description"},
                    {
                        data: null,
                        render: function(data, type, row) {
                            var status = parseInt(row.status);
                            var id = parseInt(data.BannerID);
                            var buttonClass = status === 1 ? 'btn-success' : 'btn-danger';
                            var buttonText = status === 1 ? 'Active' : 'Deactive';
                            return `<button type="button" data-id="${id}" class="btn ${buttonClass} status-button">${buttonText}</button>`;
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
                        data: null,
                        render: function (data, type, row) {
                            var id = parseInt(data.BannerID);
                            return `<button type="button" data-id="${id}" class="btn btn-danger delete-button"><i class="icon-trash" style="font-size:30px;"></i></button>`
                        }
                    },

                ],
                "order": [[0, "desc"]] // Sort by the first column initially
            });

            $('#order-details-datatables tbody').on('click', 'button.status-button', function() {
                var button = this;

                let data = table.row($(this).closest('tr')).data();
                let status = parseInt(data.status);
                let id = data.BannerID;

                status = status === 1 ? 0 : 1;

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const params = {
                    id: id,
                    status: status,
                };
                const formData = new URLSearchParams(params);
                let url = '/manage_banner_status';

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
                        url: '/delete_banner/' + id,
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
    <script>
        document.getElementById('picture').addEventListener('change', previewImage);

        function previewImage(event) {
            const file = event.target.files[0];
            const imageContainer = document.getElementById('image-container');
            imageContainer.innerHTML = '';

            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const card = createImageCard(e.target.result);
                    imageContainer.appendChild(card);
                };
                reader.readAsDataURL(file);
            }
        }

        function createImageCard(imageSrc) {
            const card = document.createElement('div');
            card.classList.add('card', 'upload-card');
            card.innerHTML = `
        <img src="${imageSrc}" alt="Image Preview" class="image-preview" style="display: block; width: 100%;">
        <button class="delete-btn" onclick="removeImage()">×</button>
    `;
            return card;
        }

        function removeImage() {
            const imageContainer = document.getElementById('image-container');
            imageContainer.innerHTML = '';
            document.getElementById('picture').value = '';
        }


    </script>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="BannerForm"  enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="bannerName">Category Name</label>
                            <input type="text" class="form-control" id="bannerName" name="bannerName" required>
                        </div>
                        <div class="form-group">
                            <label for="bannerDescription">Description</label>
                            <textarea class="form-control" id="bannerDescription" name="bannerDescription" rows="3"
                                      required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="bannerImage">Image</label>
                            <div id="image-container" class="mt-1"></div>
                            <input id="picture" type="file" accept="image/*" onchange="previewImage(event)"
                                   class="mt-2">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="saveBannerBtn" style="width:100%;">Save
                                changes
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{--this script use for submit form data--}}
    <script>
        $('#BannerForm').on('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Append the image file
            const bannerImage = document.getElementById('picture').files[0];
            if (bannerImage) {
                formData.append('picture', bannerImage);
            }

            $.ajax({
                url: '/banner_manage', // Change this to your actual endpoint
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.message === "successful") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Operation was successful!',
                            timer: 3000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = response.url;
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Failed',
                            text: response.message,
                            timer: 3000
                        });
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'An error occurred';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    Swal.fire({
                        icon: 'warning',
                        title: 'Failed',
                        text: errorMessage,
                        timer: 3000
                    });
                }
            });
        });
    </script>

@endsection
