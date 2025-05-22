<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="p-6 bg-gray-100 min-h-screen">

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white p-5 rounded-lg shadow">
                <p class="text-gray-500">Total Products</p>
                <h3 class="text-2xl font-bold">{{ $totalProducts }}</h3>
            </div>
            <div class="bg-white p-5 rounded-lg shadow">
                <p class="text-gray-500">Total Orders</p>
                <h3 class="text-2xl font-bold">{{ $totalOrders }}</h3>
            </div>
            <div class="bg-white p-5 rounded-lg shadow">
                <p class="text-gray-500">Paid Orders</p>
                <h3 class="text-2xl font-bold">{{ $paidOrders }}</h3>
            </div>
            <div class="bg-white p-5 rounded-lg shadow">
                <p class="text-gray-500">Pending Orders</p>
                <h3 class="text-2xl font-bold">{{ $pendingOrders }}</h3>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-white p-5 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-4">Orders Overview</h3>
                <canvas id="ordersChart" height="150"></canvas>
            </div>
            <div class="bg-white p-5 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-4">Products by Category</h3>
                <canvas id="productsChart" height="150"></canvas>
            </div>
        </div>

        <!-- Recent Orders Table -->
        <div class="bg-white p-5 rounded-lg shadow">
            <h3 class="text-xl font-semibold mb-4">Recent Orders</h3>
            <table class="w-full text-left">
                <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
                    <tr>
                        <th class="p-3">ID</th>
                        <th class="p-3">Customer</th>
                        <th class="p-3">Total</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Updated At</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($recentOrders as $order)
                        <tr class="border-b">
                            <td class="p-3">{{ $order->id }}</td>
                            <td class="p-3">{{ $order->name }}</td>
                            <td class="p-3">{{ $order->total }}</td>
                            <td class="p-3">
                                <span class="text-sm px-2 py-1 rounded {{ $order->status == 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="p-3">{{ $order->updated_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ordersCtx = document.getElementById('ordersChart').getContext('2d');
        new Chart(ordersCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($orderChartLabels) !!},
                datasets: [{
                    label: 'Orders',
                    data: {!! json_encode($orderChartData) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.5)'
                }]
            }
        });

        const productsCtx = document.getElementById('productsChart').getContext('2d');
        new Chart(productsCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($categoryLabels) !!},
                datasets: [{
                    label: 'Products',
                    data: {!! json_encode($categoryData) !!},
                    backgroundColor: [
                        '#60a5fa', '#34d399', '#f87171', '#fbbf24'
                    ]
                }]
            }
        });
    </script>
</x-app-layout>
