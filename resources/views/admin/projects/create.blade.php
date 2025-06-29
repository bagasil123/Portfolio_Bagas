<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Menampilkan error validasi jika ada --}}
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Oops!</strong>
                            <span class="block sm:inline">There were some problems with your input.</span>
                            <ul class="mt-3 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Form untuk menambah proyek baru --}}
                    {{-- Pastikan ada enctype="multipart/form-data" untuk upload file --}}
                    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf {{-- Token keamanan wajib untuk form di Laravel --}}

                        <div class="space-y-6">
                            {{-- Project Title --}}
                            <div>
                                <label for="title" class="block text-sm font-medium">Project Title</label>
                                <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md dark:bg-gray-700 border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('title') }}" required>
                            </div>

                            {{-- Project Image --}}
                            <div>
                                <label for="image" class="block text-sm font-medium">Project Image</label>
                                <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" required>
                                <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF, SVG up to 2MB.</p>
                            </div>

                            {{-- Category --}}
                            <div>
                                <label for="category" class="block text-sm font-medium">Category</label>
                                <select name="category" id="category" class="mt-1 block w-full rounded-md dark:bg-gray-700 border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    <option value="" disabled selected>Select a category</option>
                                    <option value="Website" @if(old('category') == 'Website') selected @endif>Website</option>
                                    <option value="Application" @if(old('category') == 'Application') selected @endif>Application</option>
                                    <option value="Visual" @if(old('category') == 'Visual') selected @endif>Visual</option>
                                </select>
                            </div>

                             {{-- Live Demo URL --}}
                             <div>
                                <label for="live_demo_url" class="block text-sm font-medium">Live Demo URL (Optional)</label>
                                <input type="url" name="live_demo_url" id="live_demo_url" class="mt-1 block w-full rounded-md dark:bg-gray-700 border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('live_demo_url') }}" placeholder="https://example.com">
                            </div>

                            {{-- Source Code URL --}}
                            <div>
                                <label for="source_code_url" class="block text-sm font-medium">Source Code URL (Optional)</label>
                                <input type="url" name="source_code_url" id="source_code_url" class="mt-1 block w-full rounded-md dark:bg-gray-700 border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('source_code_url') }}" placeholder="https://github.com/user/repo">
                            </div>

                            {{-- Tech Stack Description --}}
                            <div>
                                <label for="tech_stack_description" class="block text-sm font-medium">Tech Stack (HTML)</label>
                                <textarea name="tech_stack_description" id="tech_stack_description" rows="8" class="mt-1 block w-full rounded-md dark:bg-gray-700 border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('tech_stack_description') }}</textarea>
                                <p class="mt-2 text-xs text-gray-500">
                                    Paste the complete HTML for the tech tags here. <br>
                                    Example for one tag:
                                </p>
                                <pre class="mt-1 text-xs text-gray-400 bg-gray-900 p-2 rounded-md overflow-x-auto"><code>&lt;div class="tech-tag"&gt;
    &lt;img src="{{ asset('assets/icons/html5.svg') }}" alt="HTML" class="tech-icon" style="filter: ..."&gt;
    HTML
&lt;/div&gt;</code></pre>
                            </div>
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-600 disabled:opacity-25 transition">
                                Add Project
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>