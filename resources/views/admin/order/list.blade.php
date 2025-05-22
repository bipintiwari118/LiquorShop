<x-app-layout>
    <x-slot name="header">
        {{ __('Order List') }}
    </x-slot>

    <div class="container mx-auto">
        <div class="py-8">

            <!-- Search Bar -->
            <div class="mb-4 float-right">
                <form method="GET" action="{{ route('order.list') }}" class="flex items-center space-x-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by Name, Email or Order ID"
                        class="w-4/5 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Search
                    </button>
                    @if (request('search'))
                        <a href="{{ route('order.list') }}"
                            class="px-4 py-2 text-gray-700 underline hover:text-gray-900">
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            <!-- Table Section -->
            <div class=" w-full">
                <div class="min-w-full w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full  w-full  leading-normal">
                        @if (Session::has('success'))
                            <div class="text-green-500 text-[20px] mt-1  p-[10px]" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-[16px] font-bold text-gray-600 uppercase tracking-wider">
                                    ID
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-[16px] font-bold text-gray-600 uppercase tracking-wider">
                                    Customer Name
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-[16px] font-bold text-gray-600 uppercase tracking-wider">
                                    Email
                                </th>

                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-[16px] font-bold text-gray-600 uppercase tracking-wider">
                                    Total Amount
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-[16px] font-bold text-gray-600 uppercase tracking-wider">
                                    Payment Status
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-[16px] font-bold text-gray-600 uppercase tracking-wider">
                                    Delivery Status
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-[16px] font-bold text-gray-600 uppercase tracking-wider">
                                    Updated Date
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-right text-[16px] font-bold text-gray-600 uppercase tracking-wider"
                                    style="min-width: 180px; width: 200px;">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example Row -->
                            @if($orders->count())

                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-[16px]">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $order->id }}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-[16px]">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $order->name }}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-[16px]">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $order->email }}</p>
                                        </td>

                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-[16px]">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $order->total }}</p>
                                        </td>

                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-[16px]">
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $order->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-[16px]">
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $order->delivery === 'delivered' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ ucfirst($order->delivery) }}
                                            </span>
                                        </td>

                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-[16px]">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $order->updated_at->format('Y-m-d') }}
                                            </p>
                                        </td>

                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-[16px] text-right">
                                            <a href="{{ route('order.edit', $order->id) }}"
                                                class="text-blue-500 hover:text-blue-700">Edit</a>
                                            <a href="{{ route('order.delete', $order->id) }}"
                                                class="text-red-500 hover:text-red-700 ml-4"
                                                onclick="alert('Are you sure to delete this order')">Delete</a>
                                            <a href="{{ route('order.view', $order->id) }}"
                                                class="text-green-500 hover:text-red-700 ml-4">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            @else
                                <tr>
                                    <td colspan="8" class="px-5 py-5 border-b border-gray-200 bg-white text-[20px]">
                                        <p class="text-red-600 whitespace-no-wrap text-center">Orders Not Found.</p>
                                    </td>
                                </tr>

                            @endif
                                    <!-- Add more rows as needed -->
                        </tbody>

                    </table>
                </div>
            </div>
            <!-- Pagination Section -->
            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        </div>
    </div>

</x-app-layout>
