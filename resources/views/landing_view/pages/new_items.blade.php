<style>
    .product-card {
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 20px;
        text-align: center;
    }

    .product-media {
        position: relative;
        width: 100%;
        padding-top: 100%; /* This maintains a 1:1 aspect ratio for the container */
        overflow: hidden;
    }

    .product-image img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensures the image covers the container without distortion */
    }

    .product-label {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #ff5c5c;
        color: #fff;
        padding: 5px;
        font-size: 12px;
    }

    .product-wish {
        position: absolute;
        top: 10px;
        right: 10px;
        background: transparent;
        border: none;
        font-size: 18px;
    }

    .product-content {
        margin-top: 15px;
    }

    .product-rating .icofont-star {
        color: #ffd700;
    }

    .product-name {
        font-size: 16px;
        margin: 10px 0;
    }

    .product-price {
        font-size: 14px;
        color: #888;
    }

    .product-item {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 10px;
    }

    .product-add {
        background: #28a745;
        color: #fff;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }

    .product-action {
        display: flex;
        align-items: center;
    }

    .aminus, .action-plus {
        background: #ddd;
        border: none;
        padding: 5px;
        cursor: pointer;
    }

    .action-input {
        width: 30px;
        text-align: center;
    }
</style>

<div class="container">
    <div class="col">
        <div class="section-heading">
            <h2>Products</h2>
            <hr>
        </div>
    </div>
    <div class="row">
        @foreach($products as $list)
            <div class="col-md-2 col-sm-4 col-6">
                <div class="product-card">
                    <div class="product-media">
{{--                        <div class="product-label"><label class="label-text new">new</label></div>--}}
                        <button class="product-wish wish"><i class="fas fa-heart"></i></button>
                        <a class="product-image" href="product-video.html">
                            <img src="{{ asset('storage/' . $list->picture) }}" class="img-fluid" alt="product">
                        </a>
                    </div>
                    <div class="product-content">
                        <div class="product-rating">
                            <i class="active icofont-star"></i>
                            <i class="active icofont-star"></i>
                            <i class="active icofont-star"></i>
                            <i class="active icofont-star"></i>
                            <i class="icofont-star"></i>
                            <a href="product-video.html">(3)</a>
                        </div>
                        <h6 class="product-name"><a href="product-video.html">{{ $list->Name }}</a></h6>
                        <h6 class="product-price">
                            <span id="unit-price">Tk:{{ $list->Price }}<small>/(per)kg</small></span>
                        </h6>
                        <div class="product-item">
                            <button class="product-add" title="Add to Cart"
                                    data-id="{{ $list->SKU }}" data-price="{{ $list->Price }}">
                                <i class="fas fa-shopping-basket"></i><span>add</span>
                            </button>
                            <div class="product-action" style="display: none;">
                                <button class="aminus" title="Quantity Minus"><i class="icofont-minus"></i></button>
                                <input class="action-input" title="Quantity Number" type="text" name="quantity" value="0" data-sku="{{ $list->SKU }}">
                                <button class="action-plus" title="Quantity Plus"><i class="icofont-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col">
            <div class="section-btn-25">
{{--                <a href="shop-4column.html" class="btn btn-outline">--}}
{{--                    <i class="fas fa-eye"></i><span>view all new item</span>--}}
{{--                </a>--}}
            </div>
        </div>
    </div>
</div>
