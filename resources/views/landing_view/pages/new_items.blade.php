<section class="section newitem-part">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-heading">
                    <h2>MANGO</h2>
                    <hr>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <ul class="new-slider slider-arrow">
                    @foreach($products as $list)
                        @if($products->isEmpty())
                            <p>No product images available.</p>
                        @else
                            <li>
                                <div class="product-card">
                                    <div class="product-media">
                                        <div class="product-label"><label class="label-text new">new</label></div>
                                        <button class="product-wish wish"><i class="fas fa-heart"></i></button>
                                        <a class="product-image" href="product-video.html"><img
                                                src="{{ asset($list->picture) }}" alt="product"></a>
{{--                                        <div class="product-widget">--}}
{{--                                            <a title="Product Compare" href="compare.html" class="fas fa-random"></a>--}}
{{--                                            <a title="Product Video" href="https://youtu.be/9xzcVxSBbG8"--}}
{{--                                               class="venobox fas fa-play" data-autoplay="true" data-vbtype="video"></a>--}}
{{--                                            <a title="Product View" href="#" class="fas fa-eye" data-bs-toggle="modal"--}}
{{--                                               data-bs-target="#product-view"></a>--}}
{{--                                        </div>--}}
                                    </div>
                                    <div class="product-content">
                                        <div class="product-rating"><i class="active icofont-star"></i><i
                                                class="active icofont-star"></i><i class="active icofont-star"></i><i
                                                class="active icofont-star"></i><i class="icofont-star"></i><a
                                                href="product-video.html">(3)</a>
                                        </div>
                                        <h6 class="product-name"><a href="product-video.html">{{$list->Name}}</a></h6>
                                        <h6 class="product-price">
                                            <span id="unit-price">Tk:{{$list->Price}}<small>/(per)kg</small></span>
                                        </h6>
                                        <div class="product-item">
                                            <button class="product-add" title="Add to Cart" data-id="{{ $list->SKU }}" data-price="{{ $list->Price }}"><i class="fas fa-shopping-basket"></i><span>add</span></button>
                                            <div class="product-action" style="display: none;">
                                                <button class="aminus" title="Quantity Minus"><i class="icofont-minus"></i></button>
                                                <input class="action-input" title="Quantity Number" type="text" name="quantity" value="0" data-sku="{{ $list->SKU }}">
                                                <button class="action-plus" title="Quantity Plus"><i class="icofont-plus"></i></button>
                                            </div>
                                        </div>



                                        {{--                                        <button--}}
{{--                                            class="custom-btn"--}}
{{--                                            title="Add to Cart"--}}
{{--                                            data-bs-toggle="modal"--}}
{{--                                            data-bs-target="#product-view"--}}
{{--                                            data-id="{{ $list->ProductID }}" >--}}
{{--                                            <i class="fas fa-shopping-basket"></i><span>add</span>--}}
{{--                                        </button>--}}
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach

                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="section-btn-25"><a href="shop-4column.html" class="btn btn-outline">
                        <i class="fas fa-eye"></i><span>view all new item</span></a>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="section promo-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="promo-content" style="background: url(front_assets/images/mango/I.jpg) no-repeat center;">
{{--                    <h3>only <span>$45</span>per kilogram</h3>--}}
                    <h2>Fresh Mango</h2>
{{--                    <a href="shop-4column.html" class="btn btn-inline"><i class="fas fa-shopping-basket"></i><span>shop now</span></a>--}}
                </div>
            </div>
        </div>
    </div>
</section>






<script>
    // Get products from local storage
    function getProductsFromLocalStorage() {
        const cartCountElement = document.getElementById('cart-count');
        let product = JSON.parse(localStorage.getItem('products')) || [];
        // Count the total number of items in the cart array
        let totalItems = product.length;
        // Ensure the count is a string before assigning it to textContent
        cartCountElement.textContent = totalItems.toString();
        return product;

    }

    // Save products to local storage
    function saveProductsToLocalStorage(products) {
        localStorage.setItem('products', JSON.stringify(products));
    }

    // Add product to cart
    function addToCart(sku,price) {
        let products = getProductsFromLocalStorage();
        let product = products.find(p => p.sku === sku);

        if (product) {
            product.quantity += 1;
        } else {
            products.push({ sku: sku, quantity: 1, price:price, totalPrice:price});
        }

        saveProductsToLocalStorage(products);
        updateUI(sku);
    }

    // Update product quantity
    function updateQuantity(sku, delta, parsedBasePrice) {
        let products = getProductsFromLocalStorage();
        let productIndex = products.findIndex(p => p.sku === sku);

        if (productIndex !== -1) {
            products[productIndex].quantity += delta;

            if (products[productIndex].quantity <= 0) {
                // Remove product if quantity is 0 or less
                products.splice(productIndex, 1);
            }else{
                products[productIndex].totalPrice = (products[productIndex].price * products[productIndex].quantity).toFixed(2);
            }

            saveProductsToLocalStorage(products);
            updateUI(sku);
        }
    }

    // Update UI
    function updateUI(sku) {
        let products = getProductsFromLocalStorage();
        let product = products.find(p => p.sku === sku);
        let quantity = product ? product.quantity : 0;

        let addButton = document.querySelector(`button.product-add[data-id="${sku}"]`);
        let productAction = addButton.closest('.product-item').querySelector('.product-action');
        let inputField = productAction.querySelector(`input[data-sku="${sku}"]`);

        if (quantity > 0) {
            addButton.style.display = 'none';
            productAction.style.display = 'flex';
            inputField.value = quantity;
        } else {
            addButton.style.display = 'block';
            productAction.style.display = 'none';
            inputField.value = 0; // Set input value to 0 when quantity is 0 or less
        }
    }

    // Event listeners for add, plus, and minus buttons
    document.addEventListener('click', function(event) {
        if (event.target.closest('.product-add')) {
            let sku = event.target.closest('.product-add').getAttribute('data-id');
            let price = event.target.closest('.product-add').getAttribute('data-price');
            addToCart(sku,price);
        }

        if (event.target.closest('.action-plus')) {
            let sku = event.target.closest('.product-action').querySelector('input').getAttribute('data-sku');
            updateQuantity(sku, 1);
        }

        if (event.target.closest('.aminus')) {
            let sku = event.target.closest('.product-action').querySelector('input').getAttribute('data-sku');
            updateQuantity(sku, -1);
        }
    });

    // Initialize UI based on local storage data
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementById('quantity-input');
        let products = getProductsFromLocalStorage();
        products.forEach(product => {
            updateUI(product.sku,quantityInput);
        });
    });

</script>





{{--<script>--}}
{{--    document.addEventListener('DOMContentLoaded', function () {--}}
{{--        const buttons = document.querySelectorAll('.custom-btn');--}}
{{--        buttons.forEach(function (button) {--}}
{{--            button.addEventListener('click', function () {--}}
{{--                const productId = this.getAttribute('data-id');--}}
{{--                fetch(`/products/${productId}`)--}}
{{--                    .then(response => response.json())--}}
{{--                    .then(data => {--}}
{{--                        document.getElementById('product-name').textContent = data.name;--}}
{{--                        document.getElementById('product-name').href = data.link || '#';--}}
{{--                        document.getElementById('product-sku').textContent = data.sku;--}}
{{--                        document.getElementById('product-brand').textContent = data.brand;--}}
{{--                        document.getElementById('product-brand').href = data.brand_link || '#';--}}
{{--                        document.getElementById('product-original-price').textContent = `TK:${data.original_price}`;--}}
{{--                        document.getElementById('product-price').innerHTML = `TK:${data.price}<small>/per kilo</small>`;--}}
{{--                        document.getElementById('total-price').innerHTML = `${data.price}<small></small>`;--}}
{{--                        document.getElementById('quantity-input').value = 1;--}}
{{--                        document.getElementById('product-description').textContent = data.description;--}}
{{--                        let previewSlider = document.getElementById('preview-slider');--}}
{{--                        previewSlider.innerHTML = '';--}}
{{--                        data.images.forEach(image => {--}}
{{--                            let previewItem = document.createElement('li');--}}
{{--                            previewItem.innerHTML = `<img src="${image}" alt="product">`;--}}
{{--                            previewSlider.appendChild(previewItem);--}}
{{--                        });--}}
{{--                        const addToCartButton = document.getElementById('p-add');--}}
{{--                        addToCartButton.setAttribute('data-id', data.sku);--}}
{{--                        addToCartButton.setAttribute('data-sku', data.sku);--}}
{{--                        // const modal = new bootstrap.Modal(document.getElementById('product-view'));--}}

{{--                        let cart = JSON.parse(localStorage.getItem('cart')) || [];--}}
{{--                        let itemExists = cart.some(cartItem => cartItem.id === data.sku);--}}
{{--                        if(itemExists){--}}
{{--                            addToCartButton.textContent = "Already added in cart";--}}
{{--                            addToCartButton.style.backgroundColor = "pink"; // or any color you want--}}
{{--                        }else{--}}
{{--                            addToCartButton.textContent = "Add to cart";--}}
{{--                            addToCartButton.style.backgroundColor = "#119744";--}}
{{--                        }--}}
{{--                        modal.show();--}}
{{--                    })--}}
{{--                    .catch(error => console.error('Error fetching product data:', error));--}}
{{--            });--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
