// Event listener for DOMContentLoaded to initialize the UI
document.addEventListener('DOMContentLoaded', () => {
    getProductsFromLocalStorage();
    initializeUI();
});

// Get products from local storage
function getProductsFromLocalStorage() {
    const cartCountElementMobile = document.getElementById('mobile-cart-count');
    const cartCountElementPC = document.getElementById('pc-cart-count');

    let products = JSON.parse(localStorage.getItem('products')) || [];
    let totalItems = products.length;
    cartCountElementMobile.textContent = totalItems.toString();
    cartCountElementPC.textContent = totalItems.toString();
    return products;
}

// Save products to local storage
function saveProductsToLocalStorage(products) {
    localStorage.setItem('products', JSON.stringify(products));
    updateCartCount();
}

// Update cart count for mobile and PC views
function updateCartCount() {
    const cartCountElementMobile = document.getElementById('mobile-cart-count');
    const cartCountElementPC = document.getElementById('pc-cart-count');
    let products = JSON.parse(localStorage.getItem('products')) || [];
    let totalItems = products.length;
    cartCountElementMobile.textContent = totalItems.toString();
    cartCountElementPC.textContent = totalItems.toString();
}

// Add product to cart
async function addToCart(sku, price) {
    let products = getProductsFromLocalStorage();
    let product = products.find(p => p.sku === sku);

    if (product) {
        product.quantity += 1;
        product.totalPrice = product.quantity * product.price;
    } else {
        product = {sku: sku, quantity: 1, price: price, totalPrice: price};
        products.push(product);
    }

    saveProductsToLocalStorage(products);
    updateUI(sku);

    // Send product data to the server
    await sendRequest('/addToCart', product, 'Error adding product to cart on server:');
}

// Update product quantity
async function updateQuantity(sku, delta) {
    let products = getProductsFromLocalStorage();
    let productIndex = products.findIndex(p => p.sku === sku);

    if (productIndex !== -1) {
        products[productIndex].quantity += delta;

        if (products[productIndex].quantity <= 0) {
            await removeProductFromServer(products, productIndex, sku);
        } else {
            products[productIndex].totalPrice = (products[productIndex].price * products[productIndex].quantity).toFixed(2);
            saveProductsToLocalStorage(products);
            updateUI(sku);

            // Send updated product data to the server
            await sendRequest('/updateCart', products[productIndex], 'Error updating product quantity on server:');
        }

        // Clear cart on server if empty
        if (products.length === 0) {
            await clearCartOnServer();
        }
    }
}

// Send request to the server
async function sendRequest(url, data, errorMessage) {
    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const responseData = await response.json();
        console.log(`${url} response:`, responseData);
    } catch (error) {
        console.error(errorMessage, error);
    }
}

// Remove product from server
async function removeProductFromServer(products, productIndex, sku) {
    await sendRequest('/removeFromCart', {sku: products[productIndex].sku}, 'Error removing product from server:');
    products.splice(productIndex, 1);
    saveProductsToLocalStorage(products);
    updateUI(sku);
}

// Clear cart on server
async function clearCartOnServer() {
    await sendRequest('/clearCart', {}, 'Error clearing cart on server:');
}

// Update UI
// Update UI
function updateUI(sku) {
    let products = getProductsFromLocalStorage();
    let product = products.find(p => p.sku === sku);
    let quantity = product ? product.quantity : 0;

    let addButton = document.querySelector(`button.product-add[data-id="${sku}"]`);
    if (!addButton) {
        console.error(`Could not find addButton for SKU ${sku}`);
        return;
    }

    let productItem = addButton.closest('.product-item');
    if (!productItem) {
        console.error(`Could not find product-item for SKU ${sku}`);
        return;
    }

    let productAction = productItem.querySelector('.product-action');
    if (!productAction) {
        console.error(`Could not find product-action for SKU ${sku}`);
        return;
    }

    let inputField = productAction.querySelector(`input[data-sku="${sku}"]`);
    if (!inputField) {
        console.error(`Could not find inputField for SKU ${sku}`);
        return;
    }

    if (quantity > 0) {
        addButton.style.display = 'none';
        productAction.style.display = 'flex';
        inputField.value = quantity;
    } else {
        addButton.style.display = 'block';
        productAction.style.display = 'none';
        inputField.value = 0;
    }
}


// Event listeners for add, plus, and minus buttons
document.addEventListener('click', function (event) {
    if (event.target.closest('.product-add')) {
        let button = event.target.closest('.product-add');
        let sku = button.getAttribute('data-id');
        let price = button.getAttribute('data-price');
        addToCart(sku, price);
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
function initializeUI() {
    let products = getProductsFromLocalStorage();
    products.forEach(product => {
        updateUI(product.sku);
    });
}
