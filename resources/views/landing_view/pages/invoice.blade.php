<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>


    <style>
        body {
            font-family: 'Nikosh', sans-serif;
        }


        .container {
            width: 100%;
            padding: 20px;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .order-info, .receiver-info, .order-summary {
            margin-bottom: 20px;
        }
        .order-products table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-products table, .order-products th, .order-products td {
            border: 1px solid #000;
        }
        .order-products th, .order-products td {
            padding: 10px;
            text-align: left;
        }
        .total {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Invoice</h1>
    </div>

    <div class="order-info">
        <p><strong>Order ID:</strong> {{ $order->id }}</p>
        <p><strong>Date:</strong> {{ $order->created_at->format('Y-m-d') }}</p>
    </div>

    <div class="receiver-info">
        <h2>Receiver's Information</h2>
        <p><strong>Name:</strong> {{ $order->receiver_name }}</p>
        <p><strong>Phone Number:</strong> {{ $order->phone_number }}</p>
        <p><strong>Address:</strong> {{ $order->address }}</p>
        <p><strong>District:</strong> {{ $order->district }}</p>
        <p><strong>City:</strong> {{ $order->city }}</p>
    </div>

    <div class="order-summary">
        <h2>Order Summary</h2>
        <div class="order-products">
            <table>
                <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->Name }}</td> <!-- Assuming 'name' is the column name for product name -->
                        <td>{{ $product->Description}}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>Tk {{ number_format($product->pivot_price, 2) }}</td>
                        <td>Tk {{ number_format($product->pivot_price * $product->quantity, 2) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <p class="total">Total Price: Tk {{ number_format($order->total_price, 2) }}</p>
    </div>

    <div class="footer">
        <p>Thank you for your order!</p>
    </div>
</div>
</body>
</html>
