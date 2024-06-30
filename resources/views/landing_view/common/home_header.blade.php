

<script>
    // Function to update cart count
    function updateCartCount() {
        // Retrieve the products array from local storage
        const products = JSON.parse(localStorage.getItem('products'));
        // Check if products array exists and is an array
        if (products && Array.isArray(products)) {
            // Get the length of the products array
            const cartCount = products.length;

            // Update the cart count on the webpage
            document.getElementById('pc-cart-count').innerText = cartCount;
            document.getElementById('mobile-cart-count').innerText = cartCount;
        } else {
            // If products array does not exist, set cart count to 0
            document.getElementById('pc-cart-count').innerText = 0;
            document.getElementById('mobile-cart-count').innerText = 0;
        }
    }

    // Call the function to update cart count on page load
    updateCartCount();

</script>
