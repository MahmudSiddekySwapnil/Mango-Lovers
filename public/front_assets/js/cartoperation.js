document.addEventListener('DOMContentLoaded', function() {
    console.log("cartoperation.js loaded");

    const cartBtnMobile = document.querySelector('.cart-btn');
    const cartBtnPC = document.querySelector('.header-cart');
    const cartSidebar = document.querySelector('.cart-sidebar');
    const cartCloseBtn = document.querySelector('.cart-sidebar .cart-close');
    const quantityInput = document.getElementById('quantity-input');
    const pricePerItemElement = document.getElementById('product-price');
    const totalPriceElement = document.getElementById('total-price');
    const addToCartButton = document.querySelector('.p-add');
    const cartCountElement = document.getElementById('cart-count');

    let pricePerItem = 0;
    if (pricePerItemElement) {
        pricePerItem = parseFloat(pricePerItemElement.textContent.replace(/[^\d.]/g, ''));
    }

    if (!cartSidebar) {
        console.error('Cart sidebar element not found.');
        return;
    }

    // Function to open cart sidebar
    function openCartSidebar() {
        console.log("Opening cart sidebar");
        cartSidebar.classList.add('open');
        fetchCartData();
    }

    // Open cart sidebar when cart button is clicked
    function handleCartButtonClick(event) {
        event.preventDefault();
        openCartSidebar();
    }

    // Close cart sidebar when close button is clicked
    if (cartCloseBtn) {
        cartCloseBtn.addEventListener('click', function() {
            console.log("Closing cart sidebar");
            cartSidebar.classList.remove('open');
        });
    }

    // Function to fetch cart data (replace with your actual implementation)
    function fetchCartData() {
        console.log("Fetching cart data");
        fetch('/fetch-cart')
            .then(response => response.json())
            .then(data => {
                console.log("Cart data fetched", data);
                updateCartSidebar(data);
            })
            .catch(error => console.error('Error fetching cart data:', error));
    }

    // Function to update cart sidebar with fetched data
    function updateCartSidebar(cartItems) {
        console.log("Updating cart sidebar", cartItems);
        let cartList = document.querySelector('.cart-sidebar .cart-list');
        cartList.innerHTML = '';
        let totalItems = 0;
        let totalAmount = 0;

        cartItems.forEach(item => {
            totalItems += item.quantity;
            totalAmount += item.quantity * item.Price;
            let cartItemHTML = `
                <li class="cart-item" data-id="${item.SKU}">
                    <div class="cart-media">
                        <a href="#">
                            <img src="${item.picture}" alt="product">
                        </a>
                    </div>
                    <div class="cart-info-group">
                        <div class="cart-info">
                            <h6>
                                <input type="text" value="${item.SKU}" id="p-sku">
                                <a href="product-single.html">${item.Name}</a>
                            </h6>
                            <p>Unit Price - $${item.Price}</p>
                        </div>
                        <div class="cart-action-group">
                            <div class="product-action">
                                <button class="action-minus" title="Quantity Minus">
                                    <i class="icofont-minus"></i>
                                </button>
                                <input class="action-input" type="text" name="quantity" value="${item.quantity}" readonly>
                                <button class="action-plus" title="Quantity Plus">
                                    <i class="icofont-plus"></i>
                                </button>
                            </div>
                            <h6 class="item-total-price">$${(item.quantity * item.Price).toFixed(2)}</h6>
                        </div>
                    </div>
                </li>
            `;
            cartList.innerHTML += cartItemHTML;

            // Update product list input field instantly
            const productInput = document.querySelector(`input[data-sku="${item.SKU}"]`);
            if (productInput) {
                productInput.value = item.quantity;
            }
        });

        // Add event listeners for plus and minus buttons
        addCartButtonListeners();

        // Update total items and total amount in the cart sidebar
        updateCartSummary(totalItems, totalAmount);
    }

    // Function to add event listeners for plus and minus buttons
    function addCartButtonListeners() {
        document.querySelectorAll('.action-plus').forEach(button => {
            button.addEventListener('click', function() {
                let cartItem = this.closest('.cart-item');
                let quantityInput = cartItem.querySelector('.action-input');
                let quantity = parseInt(quantityInput.value);
                quantity += 1;
                updateCartItem(cartItem, quantity);
            });
        });

        document.querySelectorAll('.action-minus').forEach(button => {
            button.addEventListener('click', function() {
                let cartItem = this.closest('.cart-item');
                let quantityInput = cartItem.querySelector('.action-input');
                let quantity = parseInt(quantityInput.value);
                if (quantity > 1) {
                    quantity -= 1;
                    updateCartItem(cartItem, quantity);
                } else {
                    removeCartItem(cartItem);
                }
            });
        });
    }

    // Function to update cart item quantity and price
    async function updateCartItem(cartItem, newQuantity) {
        let sku = cartItem.getAttribute('data-id');
        let unitPrice = parseFloat(cartItem.querySelector('.cart-info p').textContent.replace('Unit Price - $', ''));
        let itemTotalPrice = cartItem.querySelector('.item-total-price');
        let oldQuantity = parseInt(cartItem.querySelector('.action-input').value);

        // Update the UI with the new quantity
        cartItem.querySelector('.action-input').value = newQuantity;
        itemTotalPrice.textContent = `$${(newQuantity * unitPrice).toFixed(2)}`;

        // Update local storage and backend with the new quantity
        await updateQuantity(sku, newQuantity - oldQuantity);

        // Update total items and total amount
        updateCartSummary();
    }

    // Function to update quantity in local storage and backend
    async function updateQuantity(sku, delta) {
        let products = getProductsFromLocalStorage();
        let productIndex = products.findIndex(p => p.sku === sku);

        if (productIndex !== -1) {
            products[productIndex].quantity += delta;

            if (products[productIndex].quantity <= 0) {
                try {
                    const response = await fetch('/removeFromCart', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({sku: products[productIndex].sku})
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const data = await response.json();
                    console.log('Product removed from server:', data);

                    products.splice(productIndex, 1);
                    saveProductsToLocalStorage(products);
                    updateUI(sku);
                } catch (error) {
                    console.error('Error removing product from server:', error);
                }
            } else {
                products[productIndex].totalPrice = (products[productIndex].price * products[productIndex].quantity).toFixed(2);

                saveProductsToLocalStorage(products);
                updateUI(sku);

                try {
                    const response = await fetch('/updateCart', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(products[productIndex])
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const data = await response.json();
                    console.log('Product quantity updated on server:', data);
                } catch (error) {
                    console.error('Error updating product quantity on server:', error);
                }
            }

            if (products.length === 0) {
                try {
                    const response = await fetch('/clearCart', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const data = await response.json();
                    console.log('Cart cleared on server:', data);
                } catch (error) {
                    console.error('Error clearing cart on server:', error);
                }
            }
        }
    }

    // Function to remove cart item
    function removeCartItem(cartItem) {
        let sku = cartItem.getAttribute('data-id');
        let quantity = parseInt(cartItem.querySelector('.action-input').value);
        cartItem.remove();

        updateQuantity(sku, -quantity);

        updateCartSummary();
    }

    // Function to update total items and total amount
    function updateCartSummary() {
        let totalItems = document.querySelectorAll('.cart-item').length;
        let totalAmount = 0;
        document.querySelectorAll('.cart-item').forEach(item => {
            totalAmount += parseFloat(item.querySelector('.item-total-price').textContent.replace('$', ''));
        });
        document.querySelector('.cart-sidebar .cart-total span').textContent = `total items (${totalItems})`;
        document.querySelector('.cart-sidebar .checkout-price').textContent = `$${totalAmount.toFixed(2)}`;
    }

    // Add event listeners based on media queries
    const mediaQuery = window.matchMedia('(max-width: 768px)');

    function handleDeviceChange(e) {
        if (e.matches) {
            cartBtnMobile?.addEventListener('click', handleCartButtonClick);
        } else {
            cartBtnPC?.addEventListener('click', handleCartButtonClick);
        }
    }

    handleDeviceChange(mediaQuery);
    mediaQuery.addListener(handleDeviceChange);

    // Function to get products from local storage
    function getProductsFromLocalStorage() {
        return JSON.parse(localStorage.getItem('products')) || [];
    }

    // Function to save products to local storage
    function saveProductsToLocalStorage(products) {
        localStorage.setItem('products', JSON.stringify(products));
    }

    // Add to cart button click event listener
    if (addToCartButton) {
        addToCartButton.addEventListener('click', async function() {
            const sku = document.getElementById('p-sku').value;
            const productName = document.getElementById('product-name').textContent;
            const productPicture = document.querySelector('.product-picture').src;
            const quantity = parseInt(quantityInput.value);
            const price = pricePerItem;
            const totalPrice = (price * quantity).toFixed(2);

            let products = getProductsFromLocalStorage();
            const productIndex = products.findIndex(p => p.sku === sku);

            if (productIndex === -1) {
                products.push({sku, name: productName, picture: productPicture, quantity, price, totalPrice});
            } else {
                products[productIndex].quantity += quantity;
                products[productIndex].totalPrice = (products[productIndex].price * products[productIndex].quantity).toFixed(2);
            }

            saveProductsToLocalStorage(products);

            updateCartSummary();

            // Send AJAX request to add to cart endpoint
            await fetch('/addToCart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({sku, name: productName, picture: productPicture, quantity, price, totalPrice})
            });

            openCartSidebar();
        });
    }
});
