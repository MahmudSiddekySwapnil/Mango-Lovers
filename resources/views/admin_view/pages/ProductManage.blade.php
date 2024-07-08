
@extends('admin_view.layouts.layouts')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .upload-card {
            width: 200px;
            height: 200px;
            border: 2px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            margin: 10px;
        }

        .upload-card:hover {
            background-color: #f8f9fa;
        }

        .upload-card input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .plus-sign {
            font-size: 50px;
            color: #6c757d;
        }

        .upload-card img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
            display: none;
        }

        .main-image {
            border: 2px solid #007bff;
        }

        .delete-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255, 0, 0, 0.7);
            border: none;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .delete-btn:hover {
            background: rgba(255, 0, 0, 0.9);
        }

        #image-container {
            display: flex;
            flex-wrap: wrap;
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product Management</h4>
                </div>
                <div class="card-body">
                    <form>
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="productName">Product Name</label>
                                    <input type="text" class="form-control" id="productName"
                                           placeholder="Enter product name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="productPrice">Product Price</label>
                                    <input type="text" class="form-control" id="productPrice"
                                           placeholder="Enter product Price">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="productStock">Product Stock</label>
                                    <input type="text" class="form-control" id="productStock"
                                           placeholder="Enter product Stock">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="comment">Short Description</label>
                                    <textarea class="form-control" id="productDescription" rows="5"
                                              style="height: 203px;"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="productCategory">Category Select</label>
                                    <select class="form-select form-control-lg" id="productCategory" name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->CategoryID }}">{{ $category->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="productStatus">Product Status</label>
                                    <select class="form-select form-control-lg" id="productStatus">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="productPictures">Product Pictures</label>
                                <div class="container mt-1">
                                    <div class="d-flex flex-wrap" id="image-container">
                                        <div class="card upload-card">
                                            <input id="service_pic" type="file" accept="image/*" multiple onchange="previewImages(event)">
                                            <div class="plus-sign">+</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="productUpload" style="width:100%">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function previewImages(event) {
            const input = event.target;
            const files = input.files;
            const imageContainer = document.getElementById('image-container');
            const existingImages = imageContainer.querySelectorAll('.image-preview');

            for (const file of files) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const card = document.createElement('div');
                    card.classList.add('card', 'upload-card');
                    card.innerHTML = `
                <img src="${e.target.result}" alt="Image Preview" class="image-preview" onclick="setAsMainImage(this)" style="display: block;">
                <button class="delete-btn" onclick="removeImage(this)">×</button>
            `;
                    // Append each card to the image container
                    imageContainer.appendChild(card);

                    // Set the first uploaded image as the main image
                    if (existingImages.length === 0 && card.querySelector('.image-preview')) {
                        card.querySelector('.image-preview').classList.add('main-image');
                    }
                };

                reader.readAsDataURL(file);
            }
        }

        function setAsMainImage(imgElement) {
            // Remove main image border from all images
            const allImages = document.querySelectorAll('.image-preview');
            allImages.forEach(img => img.classList.remove('main-image'));

            // Set the clicked image as the main image
            imgElement.classList.add('main-image');
        }

        function removeImage(button) {
            const card = button.parentElement;
            const imgElement = card.querySelector('.image-preview');

            if (imgElement.classList.contains('main-image')) {
                alert('Cannot remove the main image. Please set another image as the main image before removing this one.');
                return;
            }

            card.remove();
        }

        document.getElementById("productUpload").addEventListener("click", function (event) {
            event.preventDefault();
            const csrfTokenInput = document.querySelector('input[name="_token"]');
            const csrfTokenValue = csrfTokenInput.value;
            const formData = new FormData();
            const images = document.querySelectorAll('.image-preview');

            images.forEach((image, index) => {
                if (image.classList.contains('main-image')) {
                    formData.append('main_picture', image.src); // Mark the main image
                } else {
                    formData.append('pictures[]', image.src);
                }
            });

            formData.append('productName', $('#productName').val());
            formData.append('productPrice', $('#productPrice').val());
            formData.append('productDescription', $('#productDescription').val());
            formData.append('productStock', $('#productStock').val());
            formData.append('productCategory', $('#productCategory').val());
            formData.append('productStatus', $('#productStatus').val());

            let url = '/product_processor';

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfTokenValue,
                },
            }).then(response => response.json())
                .then(data => {
                    let message = data.message;
                    if (data.message === 'successful') {
                        window.location.href = data.url;
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Failed',
                            text: data.message,
                            timer: 3000
                        });
                    }
                }).catch((err) => {
                console.error(err);
            }).finally(() => {
                // Optionally hide a modal or perform other cleanup
            });
        });


    </script>
@endsection
