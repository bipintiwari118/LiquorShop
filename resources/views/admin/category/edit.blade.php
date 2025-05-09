<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Category') }}
    </x-slot>

    <div class="md:p-8 bg-white rounded-lg shadow-xs h-auto">
        <div class="">
            @if (Session::has('success'))
                <div class="text-green-500 text-sm mt-1  p-[10px]" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <form action="{{ route('category.update',$category->id) }}" method="post" class="w-full flex flex-col gap-y-5"
                enctype="multipart/form-data">
                @csrf
                <div class="flex items-center">
                    <label class="md:text-[18px] font-[500] md:w-[150px]">Category Name :</label>
                    <input type="text" name="name" id=""
                        class="md:w-[400px] outline-none rounded-md md:ml-[50px]" value="{{ $category->name }}">
                    @error('name')
                        <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                    @enderror
                </div>

                <button
                    class="p-[8px] bg-green-700 w-[100px] text-center text-white rounded-md hover:bg-green-900">Submit</button>
            </form>
        </div>

    </div>

</x-app-layout>
