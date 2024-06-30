@extends('landing_view.layouts.landing_temp')
@section('content')

    <style>
        .order-confirmation {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .order-confirmation h1, .order-confirmation h2 {
            color: #343a40;
        }

        .order-details, .order-summary {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .order-product img {
            width: 100px;
            height: auto;
            margin-right: 15px;
        }

        .order-total {
            font-size: 1.2em;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 5px;
        }
    </style>

    <div class="order-confirmation container mt-5">
        <h1 class="text-center mb-4">Order Confirmation</h1>
        <div class="order-details mb-5">
            <p class="order-id"><h3>Thank you for your order! Your order ID is <strong>{{ $order->orderid }}</strong></h3>.</p>
            <div class="receiver-info mb-3">
                <h2 class="mb-3">Receiver's Information</h2>
                <p><strong>Name:</strong> {{ $order->receiver_name }}</p>
                <p><strong>Phone Number:</strong> {{ $order->phone_number }}</p>
                <p><strong>Address:</strong> {{ $order->address }}</p>
                <p><strong>District:</strong> {{ $order->district }}</p>
                <p><strong>City:</strong> {{ $order->city }}</p>
            </div>
        </div>

        <div class="order-summary mb-5">
            <h2 class="mb-3">Order Summary</h2>
            <div class="order-products">
                @foreach($products as $product)
                    <div class="order-product d-flex align-items-center mb-3">
                        <img src="{{ $product->picture }}" alt="Product Image" class="img-thumbnail mr-3" style="width: 100px;">
                        <div>
                            <strong>{{ $product->name }}</strong>
                            <p>Quantity: {{ $product->quantity }}</p>
                            <p>Price: Tk {{ number_format($product->pivot_price, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="order-total mb-5 text-right">
            <strong>Total Price: Tk {{ number_format($order->total_price, 2) }}</strong>
        </div>

        <div class="text-center">
            <a href="{{ route('download.invoice', $order->orderid) }}" class="btn btn-primary">Download Invoice</a>
        </div>
    </div>
@endsection
