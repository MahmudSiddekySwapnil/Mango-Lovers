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
                                            <div class="col-lg-12 ml-2">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="hstack gap-2 flex-wrap">
                                                            <button type="button" class="btn btn-primary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal"
                                                                    data-bs-whatever="@getbootstrap">Partner Logo Upload
                                                            </button>
                                                        </div>

                                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                                             aria-labelledby="exampleModalLabel"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Partner Logo Upload</h5>
                                                                        <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form enctype="multipart/form-data">
                                                                            @csrf

                                                                            <div class="mb-3">
                                                                                <label for="recipient-name"
                                                                                       class="col-form-label">Partner
                                                                                    Title:</label>
                                                                                <input type="text" class="form-control"
                                                                                       id="partner_title">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label class="col-form-label"
                                                                                       for="image">Choose
                                                                                    Partner Logo:</label>
                                                                                <input type="file" name="image"
                                                                                       id="partner"
                                                                                       class="form-control">
                                                                            </div>

                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">
                                                                            Close
                                                                        </button>
                                                                        <button type="button" class="btn btn-primary"
                                                                                id="partnerSubmitForm">Save
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end card-body -->
                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <section class="content">
                                                    <table id="example" class="display"
                                                           style="width:100%">
                                                        <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Picture</th>
                                                            <th>Title</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
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

        </div> <!-- end col -->
    </div>
            <script type="text/javascript" language="javascript">
                let table = $('#example').DataTable({
                    ajax: {
                        url: "{{url('/show_partner_logo')}}",
                    },
                    searching: true,
                    scrollX: true,
                    scrollY: true,
                    language: {
                        decimal: ',',
                        thousands: '.'
                    },
                    "columns": [
                        {data: "id"},
                        {
                            data: "image_url",
                            render: function (data, type, row) {
                                // Assuming "picture" contains the file path of the image
                                return '<img class="image-modal" src="' + data + '" width="150" height="100" />';
                            }
                        },
                        {data: "title"},
                        {
                            data: null,
                            render: function (data, type, row) {
                                var status =  parseInt(row.status); // or Number(row.status)

                                var id = row.id;
                                var buttonClass = status === 1 ? 'btn-success' : 'btn-danger';
                                var buttonText = status === 1? 'Active' : 'Deactive';
                                // Use a data attribute to store the ID for easy access in the click event
                                return `<button  type="button" data-id="${id}" class="btn ${buttonClass} status-button">${buttonText}</button>`;
                            }
                        },
                        {
                            data: null,
                            render: function (data, type, row) {
                                var id = row.id;
                                return `<button type="button" data-id="${id}" class="btn btn-danger delete-button">Delete</button>`
                            }
                        },

                    ],
                });

                $('#example tbody').on('click', 'button.status-button', function () {
                    var button = this;
                    let data = table.row($(this).closest('tr')).data();
                    let status = parseInt(data.status);

                    let id = data.id;
                    status = status === 1 ? 0 : 1;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const params = {
                        id: id,
                        status: status,
                    };
                    const formData = new URLSearchParams(params);
                    console.log(formData);
                    let url = '/manage_status';
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
                                window.location.href = data.url;
                            } else {
                                // Handle the error case if needed
                            }
                        }).catch((err) => {
                        console.error(err);
                    })
                });
                $('#example tbody').on('click', 'img.image-modal', function () {
                    const imageUrl = $(this).attr('src');
                    // Open the modal and set the image source
                    $('#imageModal').modal('show');
                    $('#fullImage').attr('src', imageUrl);
                });
            </script>


            <script>
                $('#example tbody').on('click', 'button.delete-button', function () {
                    if (confirm("Are you sure you want to delete this image?")) {
                        const id = $(this).data('id');
                        // Send an AJAX request to delete the image
                        $.ajax({
                            url: '/delete_partner_logo/' + id,
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







    <!-- Modal using for showing full image -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Banner</b></h5>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="fullImage" src="" width="100%" height="auto"/>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <script src="admin_assets/js/PartnerManage.js"></script>
@endsection
