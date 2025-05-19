<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Order') }}
        </h2>
    </x-slot>

    <div class="w-3/4 mx-auto mt-12 ">
        <div class="bg-white shadow-xl rounded-xl p-[20px]">
            <form method="post" action="{{ route('order.update', $order->id) }}" class="mt-[20px]">
                @csrf
                <div class=" flex justify-between">
                    <h3 class="text-2xl font-bold  text-blue-700">Order Details</h3>
                    <button type="submit" class=" bg-blue-600 px-[15px] py-[10px] rounded-md text-white">
                        Update Order
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Name</label>
                        <input type="text" name='name'
                            class="w-full rounded-lg border border-gray-200 bg-gray-100 px-4 py-2 text-gray-700 focus:outline-none"
                            value="{{ $order->name }}" readonly>

                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" name='email'
                            class="w-full rounded-lg border border-gray-200 bg-gray-100 px-4 py-2 text-gray-700 focus:outline-none"
                            value="{{ $order->email }}" readonly>

                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Phone</label>
                        <input type="text" name='phone'
                            class="w-full rounded-lg border border-gray-200 bg-gray-100 px-4 py-2 text-gray-700 focus:outline-none"
                            value="{{ $order->phone }}" readonly>

                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Address</label>
                        <input type="text" name='address'
                            class="w-full rounded-lg border border-gray-200 bg-gray-100 px-4 py-2 text-gray-700 focus:outline-none"
                            value="{{ $order->address }}" readonly>

                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Delivery</label>
                        <select name="delivery"
                            class="w-full rounded-lg border border-blue-300 px-4 py-2 text-gray-700 focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
                            <option value="pending" {{ $order->delivery == 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="delivered" {{ $order->delivery == 'delivered' ? 'selected' : '' }}>Delivered
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Status</label>
                        <select name="status"
                            class="w-full rounded-lg border border-green-300 px-4 py-2 text-gray-700 focus:ring-2 focus:ring-green-400 focus:border-green-500">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Total</label>
                        <input type="text" name='total'
                            class="w-full rounded-lg border border-gray-200 bg-gray-100 px-4 py-2 text-gray-700 focus:outline-none"
                            value="{{ $order->total }}" readonly>
                    </div>
                </div>


            </form>
        </div>
    </div>
</x-app-layout>
