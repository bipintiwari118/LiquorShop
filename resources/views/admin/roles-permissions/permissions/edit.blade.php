<x-app-layout>
    <x-slot name="header">
        {{ __('Add Permission') }}
    </x-slot>

    <div>
        <form action="{{ route('permission.update',$permission->id) }}" method="POST" enctype="multipart/form-data" class="mb-[80px]">
            @csrf
            <button class="bg-blue-600 text-white px-[20px] py-[10px]  mb-[30px] float-right mr-[50px]">Update</button>
            <div class="h-auto w-full">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-700 ml-[100px]">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                   @if (Session::has('success'))
                    <div class="text-green-500 text-[20px] mt-1  p-[10px]" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="h-auto w-full flex justify-evenly">

                    <div class="w-3/5 h-auto shadow-md p-[20px] flex flex-col items-center gap-y-[20px]">
                        <div class="w-full flex flex-col gap-y-3">
                            <label for="" class="text-[20px] font-[500]">Name: <span
                                    class="text-red-600">*</span></label>
                            <input type="text" name="name" id="" class="w-full rounded-md" value="{{ $permission->name }}">
                            @error('title')
                                <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>



                </div>


            </div>
        </form>
    </div>


</x-app-layout>
