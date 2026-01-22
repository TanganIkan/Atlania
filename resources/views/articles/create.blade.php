@extends('layout.app')

@section('content')
    <main class="max-w-6xl mx-auto px-4 py-12">
        <div class="mb-10">
            <h1 class="text-2xl font-bold text-[#1a1c2e] uppercase tracking-tight">Create New Article</h1>
            <p class="text-sm text-gray-400">Share your ideas and inspirations today.</p>
        </div>

        <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data" id="article-form"
            class="space-y-6">
            @csrf

            <div
                class="relative h-72 w-full bg-gray-50 rounded-xl border-2 border-dashed border-gray-200 overflow-hidden flex flex-col items-center justify-center hover:border-[#f15a24] transition-all">
                <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden">
                <div id="placeholder-text" class="text-center">
                    <i class="fas fa-image text-3xl text-gray-300 mb-2"></i>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Click to upload image</p>
                </div>
                <input type="file" name="image" id="image-input" accept="image/*"
                    class="absolute inset-0 opacity-0 cursor-pointer">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="md:col-span-3">
                    <label class="text-[11px] font-bold text-gray-500 uppercase block mb-2 ml-1">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" required placeholder="Enter title..."
                        class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-[#f15a24] outline-none bg-white text-sm font-semibold">
                </div>

                <div class="relative">
                    <label class="text-[11px] font-bold text-gray-500 uppercase block mb-2 ml-1">Category</label>
                    <div class="relative flex items-center">
                        <select name="category_id" required
                            class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-[#f15a24] outline-none bg-white text-sm font-semibold appearance-none pr-12">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute right-4 pointer-events-none text-gray-400">
                            <i class="fas fa-chevron-down text-[10px]"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[11px] font-bold text-gray-500 uppercase block mb-2 ml-1">Content</label>
                <input type="hidden" name="content" id="content-input">
                <div class="rounded-xl border border-gray-200 overflow-hidden shadow-sm bg-white">
                    <div id="editor" class="min-h-[450px] text-sm leading-relaxed"></div>
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <a href="{{ route('dashboard') }}"
                    class="px-6 py-3 text-sm font-bold text-gray-400 hover:text-gray-600 transition">Cancel</a>
                <button type="submit"
                    class="bg-[#f15a24] text-white px-10 py-3 rounded-xl font-bold text-xs uppercase tracking-widest shadow-lg shadow-orange-100 hover:bg-orange-600 transition">
                    Publish Article
                </button>
            </div>
        </form>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quill = new Quill('#editor', {
                theme: 'snow',
                placeholder: 'Start writing your article...',
                modules: {
                    toolbar: [
                        [{
                            'header': [1, 2, false]
                        }],
                        ['bold', 'italic', 'underline'],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        ['link', 'blockquote'],
                        ['clean']
                    ]
                }
            });

            const form = document.getElementById('article-form');
            form.onsubmit = function () {
                document.getElementById('content-input').value = quill.root.innerHTML;
            };

            const imageInput = document.getElementById('image-input');
            const imagePreview = document.getElementById('image-preview');
            const placeholder = document.getElementById('placeholder-text');

            imageInput.onchange = function () {
                const [file] = imageInput.files;
                if (file) {
                    imagePreview.src = URL.createObjectURL(file);
                    imagePreview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
            };
        });

        document.addEventListener('DOMContentLoaded', function () {
            const imageInput = document.getElementById('image-input');
            const imagePreview = document.getElementById('image-preview');
            const placeholder = document.getElementById('placeholder-text');

            imageInput.onchange = function () {
                const [file] = imageInput.files;
                if (file) {
                    // Membuat URL sementara untuk preview di browser
                    imagePreview.src = URL.createObjectURL(file);
                    imagePreview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
            };
        });
    </script>
@endsection