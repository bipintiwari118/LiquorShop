<x-app-layout>
    <x-slot name="header">
        {{ __('Order View') }}
    </x-slot>

    <!-- Buttons -->
    <div class="flex justify-between items-center px-12 mb-4 no-print">
        <a href="{{ route('order.list') }}" class="p-[8px] bg-green-400 text-white w-[80px] text-center rounded">Back</a>
        <button onclick="printSection()" class="p-[8px] w-[80px] text-center bg-blue-500 text-white rounded">Print</button>
    </div>

    <!-- PRINT SECTION START -->
    <div id="printArea" class="max-w-5xl mx-auto p-6 bg-white shadow rounded-lg">
        <!-- Order ID -->
        <div class="mb-6 border-b pb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Order Details</h2>
            <p class="text-gray-600">Order ID: <span class="font-medium">{{ $order->id }}</span></p>
        </div>

        <!-- Customer Details -->
        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Customer Details</h3>
            <div class="grid grid-cols-2 gap-4 text-gray-700">
                <div><strong>Name:</strong> {{ $order->name }}</div>
                <div><strong>Email:</strong> {{ $order->email }}</div>
                <div><strong>Phone:</strong> {{ $order->phone }}</div>
                <div><strong>Address:</strong> {{ $order->address }}</div>
            </div>
        </div>

        <!-- Item Details -->
        <div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Items</h3>
            <table class="min-w-full table-auto border border-gray-200">
                <thead class="bg-gray-100 text-left text-gray-600">
                    <tr>
                        <th class="px-4 py-2 border">Item</th>
                        <th class="px-4 py-2 border">Quantity</th>
                        <th class="px-4 py-2 border">Price</th>
                        <th class="px-4 py-2 border">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($order->orderItem as $item)
                    <tr class="border-t">
                        <td class="px-4 py-2 border">{{ $item->product_name }}</td>
                        <td class="px-4 py-2 border">{{ $item->quantity }}</td>
                        <td class="px-4 py-2 border">Rs {{ $item->price }}</td>
                        <td class="px-4 py-2 border">Rs {{ $item->price * $item->quantity }}</td>
                    </tr>
                    @endforeach
                    <tr class="bg-gray-50 font-semibold">
                        <td colspan="3" class="text-right px-4 py-2 border">Total:</td>
                        <td class="px-4 py-2 border">Rs {{ $order->total }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- PRINT SECTION END -->

    <!-- Print Only Section Script -->
    <script>
        function printSection() {
            const printContents = document.getElementById('printArea').innerHTML;
            const originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload(); // Optional: to restore JS after print
        }
    </script>

    <!-- Hide Elements When Printing -->
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</x-app-layout>
