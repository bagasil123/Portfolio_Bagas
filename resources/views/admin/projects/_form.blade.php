{{--
|--------------------------------------------------------------------------
| Form Partial untuk Projects
|--------------------------------------------------------------------------
| File ini berisi semua elemen form yang dibutuhkan untuk membuat dan
| mengedit proyek, termasuk logika untuk widget upload.
--}}
<div class="space-y-6">
    {{-- Input Judul Proyek --}}
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Project Title</label>
        <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md dark:bg-gray-700" value="{{ old('title', $project->title ?? '') }}" required>
    </div>

    {{-- BAGIAN PENTING: Tombol dan Preview untuk Widget --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Project Image</label>
        {{-- 1. Tombol untuk membuka widget --}}
        <button type="button" id="upload_widget_project" class="mt-2 px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-500">
            Upload Image
        </button>
        {{-- 2. Input tersembunyi untuk menyimpan URL gambar --}}
        <input type="hidden" name="image_url" id="image_url" value="{{ old('image_url', $project->image_url ?? '') }}">
        
        <div class="mt-4">
            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Current Image:</p>
            @if(isset($project) && $project->image_url)
                <img src="{{ $project->image_url }}" id="image_preview" alt="Image Preview" class="mt-2 h-32 w-auto rounded-md">
            @else
                <img src="https://via.placeholder.com/300x200" id="image_preview" alt="Image Preview" class="mt-2 h-32 w-auto rounded-md">
            @endif
        </div>
    </div>

    {{-- Input lainnya --}}
    <div>
        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
        <select name="category" id="category" class="mt-1 block w-full rounded-md dark:bg-gray-700" required>
            @foreach(['Website', 'Application', 'Visual'] as $category)
                <option value="{{ $category }}" {{ (old('category', $project->category ?? '') == $category) ? 'selected' : '' }}>
                    {{ $category }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="live_demo_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Live Demo URL (Optional)</label>
        <input type="url" name="live_demo_url" id="live_demo_url" class="mt-1 block w-full rounded-md dark:bg-gray-700" value="{{ old('live_demo_url', $project->live_demo_url ?? '') }}">
    </div>
    <div>
        <label for="source_code_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Source Code URL (Optional)</label>
        <input type="url" name="source_code_url" id="source_code_url" class="mt-1 block w-full rounded-md dark:bg-gray-700" value="{{ old('source_code_url', $project->source_code_url ?? '') }}">
    </div>
    <div>
        <label for="tech_stack_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tech Stack (HTML)</label>
        <textarea name="tech_stack_description" id="tech_stack_description" rows="8" class="mt-1 block w-full rounded-md dark:bg-gray-700" required>{{ old('tech_stack_description', $project->tech_stack_description ?? '') }}</textarea>
    </div>

    <div class="flex justify-end">
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
            {{ isset($project) ? 'Update Project' : 'Add Project' }}
        </button>
    </div>
</div>

{{-- BAGIAN PENTING: Script untuk menjalankan Widget --}}
@push('scripts')
<script src="https://upload-widget.cloudinary.com/global/all.js" type="text/javascript"></script>
<script type="text/javascript">
    // 3. Inisialisasi widget dan menempelkannya ke tombol
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
