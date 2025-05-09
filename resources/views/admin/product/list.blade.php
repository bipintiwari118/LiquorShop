<x-app-layout>
    <x-slot name="header">
        {{ __('Product List') }}
    </x-slot>

    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-semibold leading-tight text-gray-800">Products</h2>
                <a href="{{ route('product.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add New
                </a>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <div class="min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-[16px] font-bold text-gray-600 uppercase tracking-wider">
                                    Product Name
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-[16px] font-bold text-gray-600 uppercase tracking-wider">
                                    Category
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-[16px] font-bold text-gray-600 uppercase tracking-wider">
                                    Price
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-[16px] font-bold text-gray-600 uppercase tracking-wider">
                                    Stock
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-right text-[16px] font-bold text-gray-600 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example Row -->
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-[16px]">
                                    <p class="text-gray-900 whitespace-no-wrap">Product 1</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-[16px]">
                                    <p class="text-gray-900 whitespace-no-wrap">Category 1</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-[16px]">
                                    <p class="text-gray-900 whitespace-no-wrap">$100</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-[16px]">
                                    <p class="text-gray-900 whitespace-no-wrap">50</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-[16px] text-right">
                                    <a href="#" class="text-blue-500 hover:text-blue-700">Edit</a>
                                    <a href="#" class="text-red-500 hover:text-red-700 ml-4">Delete</a>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
