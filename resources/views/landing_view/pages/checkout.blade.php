@extends('landing_view.layouts.landing_temp')
@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f0f0f0;
        }
        .checkout-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }
        .checkout-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin: 10px;
            flex: 1 1 45%;
            box-sizing: border-box;
        }
        .checkout-card h2 {
            margin-top: 0;
        }
        .checkout-form, .checkout-product-details, .checkout-total-price {
            display: flex;
            flex-direction: column;
        }
        .checkout-form label, .checkout-form input, .checkout-form textarea {
            margin-bottom: 10px;
        }
        .checkout-form input, .checkout-form textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }
        .checkout-product-details {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }
        .checkout-product {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        .checkout-product:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        .checkout-product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 20px;
        }
        .checkout-product-info {
            display: flex;
            flex-direction: column;
        }
        .checkout-product-info div {
            margin-bottom: 5px;
        }
        .checkout-total-price {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            background-color: #f9f9f9;
            text-align: right;
        }
        .checkout-payment-method {
            margin-top: 20px;
        }
        .checkout-submit-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .checkout-submit-btn:hover {
            background-color: #45a049;
        }
        @media (max-width: 768px) {
            .checkout-card {
                flex: 1 1 100%;
            }
        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="checkout-container">
        <div class="checkout-card">
            <h2>Receiver Information</h2>
            <form id="checkout-form" class="checkout-form">
                <label for="receiver-name">Receiver's Name:</label>
                <input type="text" id="receiver-name" name="receiver_name" required>

                <label for="phone-number">Phone Number:</label>
                <input type="tel" id="phone-number" name="phone_number" required>

                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="4" required></textarea>

                <label for="district">District:</label>
                <input type="text" id="district" name="district" required>

                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>
            </form>

        </div>
        <div class="checkout-card">
            <h2>Order Summary</h2>
            <div class="checkout-product-details" id="checkout-product-details">
                <!-- Products will be dynamically inserted here -->
            </div>
            <div class="checkout-total-price" id="checkout-total-price">
                <div><strong>Total Price: Tk 0.00</strong></div>
            </div>
            <div class="checkout-payment-method">
                <h3>Payment Method</h3>
                <input type="radio" id="cash-on-delivery" name="payment-method" value="cash-on-delivery" checked>
                <label for="cash-on-delivery">Cash on Delivery</label>
                <!-- Other payment options can be added here -->
            </div>
            <button class="checkout-submit-btn" type="submit" form="checkout-form">Place Order</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        fetchCartItems();

        function fetchCartItems() {
            $.ajax({
                url: '{{ route("fetch.cart") }}',
                method: 'GET',
                success: function(data) {
                    console.log(data); // Debugging: log the returned data to the console
                    let productDetails = $('#checkout-product-details');
                    let totalPrice = 0;

                    productDetails.empty(); // Clear existing content

                    if (data.length === 0) {
                        productDetails.append('<div>No items in the cart.</div>');
                    } else {
                        data.forEach(function(item) {
                            let price = Number(item.price); // Convert to number if necessary
                            let total_price = Number(item.total_price);
                            let product = `
                            <div class="checkout-product">
                                <img class="checkout-product-image" src="${item.picture}" alt="Product Image">
                                <div class="checkout-product-info">
                                    <div><strong>${item.Name}</strong></div>
                                    <div>Quantity: ${item.quantity}</div>
                                    <div>Price: Tk ${total_price.toFixed(2)}</div> <!-- Ensure price is valid before toFixed -->
                                </div>
                            </div>
                        `;
                            productDetails.append(product);
                            totalPrice += price * item.quantity; // Accumulate total price correctly

                            console.log(`Item: ${item.Name}, Quantity: ${item.quantity}, Price: Tk ${price.toFixed(2)}, Total Price So Far: Tk ${totalPrice.toFixed(2)}`);
                        });
                    }

                    console.log(`Final Total Price: Tk ${totalPrice.toFixed(2)}`);
                    $('#checkout-total-price').html(`<div><strong>Total Price: Tk ${totalPrice.toFixed(2)}</strong></div>`);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching cart items: ", status, error); // Debugging: log errors to the console
                }
            });
        }
    });

    $(document).ready(function() {
        // Set up CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Attach event listener to the form submission
        $('#checkout-form').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            // Collect form data into a FormData object
            let formData = new FormData(this);
            // Get cart items from local storage
            let cartItems = JSON.parse(localStorage.getItem('products')) || [];
            console.log(cartItems);
            // Append each cart item to the FormData object
            cartItems.forEach((item, index) => {
                formData.append(`cart_items[${index}][id]`, item.sku);
                formData.append(`cart_items[${index}][price]`, item.price);
                formData.append(`cart_items[${index}][quantity]`, item.quantity);
            });

            // Convert formData to a plain object for debugging
            let formDataObject = {};
            formData.forEach((value, key) => {
                formDataObject[key] = value;
            });
            console.log('Form Data Sent:', formDataObject); // Debugging: log the form data to the console

            // Send form data to the server
            $.ajax({
                url: '{{ route("place.order") }}',
                method: 'POST',
                processData: false, // Don't process the data
                contentType: false, // Don't set content type
                data: formData,
                success: function(response) {
                    // Clear local storage after successful order placement
                    localStorage.removeItem('products');

                    // On successful order placement, redirect to confirmation page
                    window.location.href = '/order-confirmation?order_id=' + response.order_id;
                },
                error: function(xhr, status, error) {
                    console.error("Error placing order: ", status, error);
                    console.error(xhr.responseJSON); // Debugging: log the error response to the console
                }
            });
        });
    });

</script>
@endsection
