<x-app-layout>
    <x-slot name="header">
        {{ __('Add Category') }}
    </x-slot>

    <div>
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="" class="text-[20px] font-[500]">Title: <span
                                class="text-red-600">*</span></label>
                            <input type="text" name="title" id="" class="w-full rounded-md">
                            @error('title')
                                <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="w-full flex flex-col gap-y-2">
                            <label for="" class="text-[20px] font-[500]">Price: <span
                                class="text-red-600">*</span></label>
                            <input type="number" name="price" id="" class="w-full rounded-md">
                            @error('price')
                                <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="w-full flex flex-col gap-y-2">
                            <label for="" class="text-[20px] font-[500]">Brand: <span
                                class="text-red-600">*</span></label>
                            <input type="text" name="brand" id="" class="w-full rounded-md">
                            @error('brand')
                                <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                            @enderror
                        </div>

                          <div class="w-full flex flex-col gap-y-2">
                            <label for="" class="text-[20px] font-[500]">Alcohol Per(%): <span
                                class="text-red-600">*</span></label>
                            <input type="text" name="alcohol" id="" class="w-full rounded-md">
                            @error('alcohol')
                                <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="w-full flex flex-col gap-y-2">
                            <label for="" class="text-[20px] font-[500]">Volume: <span
                                class="text-red-600">*</span></label>
                            <input type="number" name="volume" id="" class="w-full rounded-md">
                            @error('volume')
                                <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="w-full flex flex-col gap-y-2">
                            <label for="" class="text-[20px] font-[500]">Featured Image: <span
                                class="text-red-600">*</span></label>
                            <input type="file" name="featured_image" id="featured_image" class="w-full">
                            <div class="">
                                <img id="image_preview" src="#" alt="Image Preview"
                                    class="w-[100px] h-[120px] hidden object-cover rounded">
                            </div>
                            @error('featured_image')
                            <div class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</div>
                        @enderror
                        </div>

                    </div>

                    <div class="w-1/4 shadow-md h-auto p-[20px]">
                        <div class="w-full flex flex-col gap-y-2">
                            <label for="" class="text-[20px] font-[500]">Category <span
                                    class="text-red-600">*</span></label>
                            <select name="category" id="category" class="w-full rounded-md">
                                <option value="" disabled>Select Option</option>
                                @foreach ($categories as $category )
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full flex flex-col gap-y-2 mt-[20px]">
                            <label for="" class="text-[20px] font-[500]">Status <span
                                    class="text-red-600">*</span></label>
                            <select name="status" id="" class="w-full rounded-md">
                                <option value="" disabled>Select Option</option>
                                <option value="active">Active</option>
                                <option value="block">Block</option>


                            </select>
                        </div>
                        <div class="w-full flex flex-col gap-y-1 mt-6">
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


                <div class="h-auto w-full flex justify-evenly my-[50px]">
                    <div class="w-3/5 h-auto shadow-md p-[20px] flex flex-col items-center gap-y-[30px]">
                        <div class="w-full flex flex-col gap-y-2">
                            <label for="" class="text-[20px] font-[500] mb-[10px]">Descriptions: </label>
                            <textarea id="description" name="description"></textarea>
                        </div>

                    </div>

                    <div class="w-1/4 shadow-md h-auto p-[20px]">
                        <div class="w-full flex flex-col gap-y-2 mt-[10px]">
                            <label for="" class="text-[20px] font-[500]">Meta Title</label>
                            <input type="text" class="w-full rounded-md border-gray-300" name="meta_title" id="">

                        </div>
                        <div class="w-full flex flex-col gap-y-2 mt-6">
                            <label for="" class="text-[20px] font-[500]">Meta Description</label>
                            <textarea name="meta_description" id="" cols="30" rows="6" class="w-full"></textarea>

                        </div>
                    </div>

                </div>



            </div>
        </form>
    </div>

    <!-- Image Preview Script -->
    @section('scripts')
    <script>
        const imageInput = document.getElementById('featured_image');
        const imagePreview = document.getElementById('image_preview');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                }

                reader.readAsDataURL(file);
            }
        });


        $(document).ready(function() {
            $('#description').summernote({
                height: 280,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });




            $(document).on('click', '.add-faq-btn', function() {
                let $clone = $('.faq-item').last().clone();
                $clone.find('input, textarea').val('');
                $('.faq-item .add-faq-btn').remove();
                $('.faq-item .remove-btn').removeClass('hidden');

                $('#faqContainer').append($clone);

                $('.faq-item').last().find('.button-group').html(`
                <button class="remove-btn bg-red-500 text-white px-4 py-2 rounded-md">Remove</button>
                <button class="add-faq-btn bg-green-600 text-white px-4 py-2 rounded-md">Add FAQ</button>
            `);
            });

            $(document).on('click', '#faqContainer .remove-btn', function() {
                if ($('.faq-item').length > 1) {
                    $(this).closest('.faq-item').remove();

                    $('.faq-item .add-faq-btn').remove();
                    $('.faq-item').last().find('.button-group').html(`
                    <button class="remove-btn bg-red-500 text-white px-4 py-2 rounded-md ${$('.faq-item').length === 1 ? 'hidden' : ''}">Remove</button>
                    <button class="add-faq-btn bg-green-600 text-white px-4 py-2 rounded-md">Add FAQ</button>
                `);
                }
            });



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
