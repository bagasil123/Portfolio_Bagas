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
                    
                    <form action="{{ route('admin.projects.store') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            {{-- Project Title --}}
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Project Title</label>
                                <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md dark:bg-gray-700" value="{{ old('title') }}" required>
                            </div>

                            {{-- INI ADALAH BAGIAN UNTUK UPLOAD GAMBAR YANG BENAR --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Project Image</label>
                                
                                {{-- Tombol ini akan membuka pop-up Cloudinary --}}
                                <button type="button" id="upload_widget_project" class="mt-2 px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-500">
                                    Upload Image
                                </button>
                                
                                {{-- Input tersembunyi untuk menyimpan URL dari Cloudinary --}}
                                <input type="hidden" name="image_url" id="image_url" value="{{ old('image_url') }}">
                                
                                <div class="mt-4">
                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Image Preview:</p>
                                    <img src="{{ old('image_url', 'https://via.placeholder.com/300x200') }}" id="image_preview" alt="Image Preview" class="mt-2 h-32 w-auto rounded-md">
                                </div>
                            </div>

                            {{-- Category --}}
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                                <select name="category" id="category" class="mt-1 block w-full rounded-md dark:bg-gray-700" required>
                                    <option value="" disabled selected>Select a category</option>
                                    @foreach(['Website', 'Application', 'Visual'] as $category)
                                        <option value="{{ $category }}" @if(old('category') == $category) selected @endif>{{ $category }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Live Demo URL --}}
                            <div>
                                <label for="live_demo_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Live Demo URL (Optional)</label>
                                <input type="url" name="live_demo_url" id="live_demo_url" class="mt-1 block w-full rounded-md dark:bg-gray-700" value="{{ old('live_demo_url') }}" placeholder="https://example.com">
                            </div>

                            {{-- Source Code URL --}}
                            <div>
                                <label for="source_code_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Source Code URL (Optional)</label>
                                <input type="url" name="source_code_url" id="source_code_url" class="mt-1 block w-full rounded-md dark:bg-gray-700" value="{{ old('source_code_url') }}" placeholder="https://github.com/user/repo">
                            </div>

                            {{-- Tech Stack Description --}}
                            <div>
                                <label for="tech_stack_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tech Stack (HTML)</label>
                                <textarea name="tech_stack_description" id="tech_stack_description" rows="8" class="mt-1 block w-full rounded-md dark:bg-gray-700" required>{{ old('tech_stack_description') }}</textarea>
                                
                                {{-- Contoh yang ditambahkan --}}
                                <p class="mt-2 text-xs text-gray-500">
                                    Paste the complete HTML for the tech tags here. <br>
                                    Example for one tag (use icon URL from Cloudinary):
                                </p>
                                <pre class="mt-1 text-xs text-gray-400 bg-gray-900 p-2 rounded-md overflow-x-auto"><code>&lt;div class="tech-tag"&gt;
    &lt;img src="https://bagas-portfolio-hugmdmb4a2h5dzfv.southeastasia-01.azurewebsites.net/assets/icons/html5.svg" alt="HTML" class="tech-icon" style="filter: invert(56%) sepia(22%) saturate(1162%) hue-rotate(156deg) brightness(92%) contrast(92%);"&gt;
    HTML
&lt;/div&gt;</code></pre>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                                Add Project
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- INI ADALAH SCRIPT UNTUK MEMBUAT POP-UP BEKERJA --}}
    @push('scripts')
    <script src="https://upload-widget.cloudinary.com/global/all.js" type="text/javascript"></script>
    <script type="text/javascript">
        const projectWidget = cloudinary.createUploadWidget({
            cloudName: "dex2f8xur", 
            uploadPreset: "portfolio_bagas",
            folder: 'projects',
            sources: ['local', 'url'],
            styles: {
                palette: {
                    window: "#111827", sourceBg: "#1F2937", windowBorder: "#374151",
                    tabIcon: "#FFFFFF", inactiveTabIcon: "#9CA3AF", menuIcons: "#FFFFFF",
                    link: "#6366F1", action: "#6366F1", inProgress: "#6366F1",
                    complete: "#22C55E", error: "#EF4444", textDark: "#F9FAFB", textLight: "#E5E7EB"
                }
            }
        }, (error, result) => { 
            if (!error && result && result.event === "success") { 
                const secureUrl = result.info.secure_url;
                document.getElementById('image_url').value = secureUrl;
                document.getElementById('image_preview').src = secureUrl;
            }
        });

        document.getElementById("upload_widget_project").addEventListener("click", function(){
            projectWidget.open();
        }, false);
    </script>
    @endpush
</x-app-layout>
