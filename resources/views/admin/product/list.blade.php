<x-app-layout>
    <x-slot name="header">
        {{ __('Product List') }}
    </x-slot>

    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">

            <!-- Header Section -->
            <div class="flex justify-between  items-center mb-4">
                <h2 class="text-2xl font-semibold leading-tight text-gray-800">Products</h2>
                <a href="{{ route('product.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add New
                </a>


            <div class=" float-right">
                <form method="GET" action="{{ route('product.list') }}" class="flex items-center space-x-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by Name, Email or Order ID"
                        class="w-4/5 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Search
                    </button>
                    @if (request('search'))
                        <a href="{{ route('product.list') }}"
                            class="px-4 py-2 text-gray-700 underline hover:text-gray-900">
                            Clear
                        </a>
                    @endif
                </form>
            </div>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <div class="min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
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
                                    Product Name
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-[16px] font-bold text-gray-600 uppercase tracking-wider">
                                    Category
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-[16px] font-bold text-gray-600 uppercase tracking-wider">
                                    Brand
                                </th>

                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-[16px] font-bold text-gray-600 uppercase tracking-wider">
                                    Volume
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-[16px] font-bold text-gray-600 uppercase tracking-wider">
                                    Price
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-[16px] font-bold text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-[16px] font-bold text-gray-600 uppercase tracking-wider">
                                    Image
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-right text-[16px] font-bold text-gray-600 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example Row -->
                             @if ($products->count())
                            @foreach ($products as $product)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-[16px]">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $product->id }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-[16px]">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $product->title }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-[16px]">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $product->category }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-[16px]">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $product->brand }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-[16px]">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $product->volume }} ml</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-[16px]">
                                        <p class="text-gray-900 whitespace-no-wrap">$ {{ $product->price }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-[16px]">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $product->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($product->status) }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-[16px]">
                                        <img src="{{ asset($product->featured_image) }}" alt=""
                                            class="w-[50px] h-[50px]">
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-[16px] text-right">
                                        <a href="{{ route('product.edit',$product->slug) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                        <a href="{{ route('product.delete', $product->slug) }}"
                                            class="text-red-500 hover:text-red-700 ml-4"
                                            onclick="alert('Are you sure to delete this product')">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- Add more rows as needed -->
                              @else
                                <tr>
                                    <td colspan="9" class="px-5 py-5 border-b border-gray-200 bg-white text-[20px]">
                                        <p class="text-red-600 whitespace-no-wrap text-center">Products Not Found.</p>
                                    </td>
                                </tr>

                            @endif
                        </tbody>

                    </table>
                </div>
            </div>
             <!-- Pagination Section -->
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>

</x-app-layout>
