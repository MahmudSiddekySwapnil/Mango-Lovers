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
                    <form id="productForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="productName">Product Name</label>
                                    <input type="text" class="form-control" name="productName"id="productName" placeholder="Enter product name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="productPrice">Product Price</label>
                                    <input type="text" class="form-control" name="productPrice" id="productPrice" placeholder="Enter product Price">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="productStock">Product Stock</label>
                                    <input type="text" class="form-control" name="productStock" id="productStock" placeholder="Enter product Stock">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="comment">Short Description</label>
                                    <textarea class="form-control" name="productDescription" id="productDescription" rows="5" style="height: 203px;"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="productCategory">Category Select</label>
                                    <select class="form-select form-control-lg" id="productCategory" name="productCategory">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->CategoryID }}">{{ $category->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="productStatus">Product Status</label>
                                    <select class="form-select form-control-lg" id="productStatus"  name="productStatus">
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
                                    <div class="d-flex flex-wrap" id="image-container" name="image-container">
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
                    imageContainer.appendChild(card);

                    if (existingImages.length === 0 && card.querySelector('.image-preview')) {
                        card.querySelector('.image-preview').classList.add('main-image');
                    }
                };

                reader.readAsDataURL(file);
            }
        }

        function setAsMainImage(imgElement) {
            const allImages = document.querySelectorAll('.image-preview');
            allImages.forEach(img => img.classList.remove('main-image'));
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

        $('#productForm').on('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(this);
            const images = document.querySelectorAll('.image-preview');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            images.forEach((image, index) => {
                const blob = dataURItoBlob(image.src);
                if (image.classList.contains('main-image')) {
                    formData.append('main_picture', blob, `main_image_${index}.jpg`);
                } else {
                    formData.append('pictures[]', blob, `image_${index}.jpg`);
                }
            });

            $.ajax({
                url: '{{ route("product_processor") }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    if (response.message === 'successful') {
                        window.location.href = response.url;
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Failed',
                            text: response.message,
                            timer: 3000
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });

        // Convert base64 to Blob
        function dataURItoBlob(dataURI) {
            const byteString = atob(dataURI.split(',')[1]);
            const mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
            const ab = new ArrayBuffer(byteString.length);
            const ia = new Uint8Array(ab);
            for (let i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }
            return new Blob([ab], { type: mimeString });
        }

    </script>
@endsection
