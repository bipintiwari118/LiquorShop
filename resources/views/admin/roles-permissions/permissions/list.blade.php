<x-app-layout>
    <x-slot name="header">
        {{ __('Permission List') }}
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                        @if (Session::has('success'))
                            <div class="text-green-500 text-[20px] mt-1 p-[20px]" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <a href="{{ route('permission.create') }}"
                            class="inline-block float-right px-4 py-2 mb-[10px] mr-[20px] text-sm font-medium text-white bg-green-600 rounded hover:bg-green-800">
                            Add New
                        </a>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-[18px] text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Id
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-[18px] text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-[18px] text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($permissions as $permission)

                                <tr class="hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $permission->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $permission->name }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('permission.edit', $permission->id) }}"
                                            class="inline-block px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded hover:bg-indigo-700">
                                            Edit
                                        </a>
                                        <a href="{{ route('permission.delete', $permission->id) }}"
                                            class="inline-block px-4 py-2 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700 ml-2" onclick="alert('Are you sure to delete?')">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-4 mb-[100px]">
                {{ $permissions->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
