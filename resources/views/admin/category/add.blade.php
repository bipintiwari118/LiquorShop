<x-app-layout>
    <x-slot name="header">
        {{ __('Add Category') }}
    </x-slot>

    <div>
        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" class="mb-[80px]">
            @csrf
            <button class="bg-blue-600 text-white px-[20px] py-[10px]  mb-[30px] float-right mr-[50px]">Publish</button>
            <div class="h-auto w-full">
                @if (Session::has('success'))
                    <div class="text-green-500 text-[20px] mt-1  p-[10px]" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-700 ml-[100px]">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="h-auto w-full flex justify-evenly">
                    <div class="w-3/5 h-auto shadow-md p-[20px] flex flex-col items-center gap-y-[20px]">
                        <div class="w-full flex flex-col gap-y-3">
                            <label for="" class="text-[20px] font-[500]">Name: <span
                                    class="text-red-600">*</span></label>
                            <input type="text" name="name" id="" class="w-full rounded-md">
                            @error('title')
                                <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                            @enderror
                        </div>

                         <div class="w-full flex flex-col gap-y-2 mt-[10px]">
                            <label for="" class="text-[20px] font-[500]">Meta Title</label>
                            <input type="text" class="w-full rounded-md border-gray-300" name="meta_title"
                                id="">

                        </div>
                        <div class="w-full flex flex-col gap-y-2 mt-6">
                            <label for="" class="text-[20px] font-[500]">Meta Description</label>
                            <textarea name="meta_description" id="" cols="30" rows="6" class="w-full"></textarea>

                        </div>

                    </div>

                    <div class="w-1/4 shadow-md h-[300px] p-[20px]">
                        <div class="w-full flex flex-col gap-y-1 mt-1">
                            <label for="" class="text-[20px] font-[500]">Focus Keyword: </label>

                            <!-- Display Tags Here -->
                            <div id="keyword-tags" class="flex flex-wrap gap-2 mb-2"></div>

                            <!-- Hidden Input for Form Submission -->
                            <input type="hidden" name="focus_keywords[]" id="focus_keywords">

                            <!-- Input Field -->
                            <textarea id="keyword-input" rows="3" placeholder="Type keyword and press Enter"
                                class="w-full p-2 border rounded-md resize-none"></textarea>
                        </div>

                    </div>

                </div>


            </div>
        </form>
    </div>

    <!-- Image Preview Script -->
    @section('scripts')
        <script>
            $(document).ready(function() {

                $('#keyword-input').on('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        let keyword = $(this).val().trim();
                        if (keyword !== '') {
                            let tag = `
                        <div class="flex items-center bg-blue-500 text-white px-3 py-1 rounded">
                            ${keyword}
                            <button type="button" class="ml-2 text-white font-bold remove-keyword">&times;</button>
                            <input type="hidden" name="focus_keywords[]" value="${keyword}">
                        </div>
                    `;
                            $('#keyword-tags').append(tag);
                            $(this).val('');
                        }
                    }
                });

                // Remove tag
                $(document).on('click', '.remove-keyword', function() {
                    $(this).closest('div').remove();
                });


            });
        </script>
    @endsection
</x-app-layout>
