<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order View</title>
    <style>
        /* Reset */
        body,
        p,
        h1,
        h2,
        h3,
        h4,
        table {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            color: #333333;
        }

        body {
            background-color: #f3f4f6;
            padding: 20px 0;
        }

        .container {
            max-width: 600px;
            background: #ffffff;
            margin: 0 auto;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 12px;
            color: #111827;
        }

        h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #1f2937;
        }

        p {
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 12px;
            color: #374151;
        }

        strong {
            font-weight: 600;
            color: #111827;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #d1d5db;
            padding: 8px 12px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #f9fafb;
            color: #6b7280;
            font-weight: 600;
        }

        tr.total-row td {
            font-weight: 700;
            background-color: #f3f4f6;
            text-align: right;
        }

        .note {
            border-top: 1px solid #d1d5db;
            padding-top: 16px;
            font-size: 14px;
            color: #4b5563;
        }

        .note h4 {
            font-weight: 600;
            margin-bottom: 8px;
            color: #111827;
        }
    </style>
</head>

<body>
    <div class="container" role="article" aria-label="Order View">

        <!-- Greeting -->
        <h2>Dear {{ $order->name }},</h2>
        <p>We’re happy to let you know that your order has been <strong>delivered</strong> and the payment is
            <strong>confirmed</strong>.</p>

        <!-- Order Details -->
        <div>
            <h3>Order Details</h3>
            <p>Order ID: <strong>#{{ $order->id }}</strong></p>
            <p>Order Date: {{ $order->created_at->format('d M Y') }}</p>
            <p>Status: {{ ucfirst($order->status) }}</p>
            <p>Delivery: {{ ucfirst($order->delivery) }}</p>
        </div>

        <!-- Customer Details -->
        <div>
            <h3>Customer Details</h3>
            <p>Name: {{ $order->name }}</p>
            <p>Email: {{ $order->email }}</p>
            <p>Phone: {{ $order->phone }}</p>
            <p>Address: {{ $order->address }}</p>
        </div>

        <!-- Items Ordered -->
        <div>
            <h3>Items Ordered</h3>
            <table role="table" aria-label="Ordered items">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItem as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rs {{ $item->price }}</td>
                            <td>Rs {{ $item->price * $item->quantity }}</td>
                        </tr>
                    @endforeach
                    <tr class="total-row">
                        <td colspan="3">Total:</td>
                        <td>Rs {{ $order->total }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Note -->
        <div class="note">
            <h4>Note:</h4>
            <p>If you have any questions or need help, feel free to call us.</p>
            <p><strong>Emergency Contact:</strong> +977-9813834870</p>
        </div>

        <p>Thanks,<br>{{ config('app.name') }}</p>
    </div>
</body>

</html>
