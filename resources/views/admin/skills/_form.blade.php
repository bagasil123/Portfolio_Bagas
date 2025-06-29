{{--
|--------------------------------------------------------------------------
| Form Partial untuk Skills
|--------------------------------------------------------------------------
|
| File ini berisi elemen form yang digunakan bersama oleh halaman
| "Create Skill" dan "Edit Skill" untuk menghindari duplikasi kode.
|
--}}
<div class="space-y-6">
    {{-- Input Nama Skill --}}
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Skill Name</label>
        {{-- Logika `isset($skill)` untuk membedakan antara form create dan edit --}}
        <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md dark:bg-gray-700 border-gray-300 dark:border-gray-600 shadow-sm" value="{{ old('name', $skill->name ?? '') }}" required>
    </div>
    
    {{-- Input Kategori Skill --}}
    <div>
        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
        <select name="category" id="category" class="mt-1 block w-full rounded-md dark:bg-gray-700 border-gray-300 dark:border-gray-600 shadow-sm" required>
            <option value="" disabled {{ !isset($skill) ? 'selected' : '' }}>Select a category</option>
            @php
                $categories = ['IDE', 'Language and Style', 'Framework', 'Database', 'API', 'Visual', 'Virtual M and Containers'];
            @endphp
            @foreach($categories as $category)
                <option value="{{ $category }}" {{ (old('category', $skill->category ?? '') == $category) ? 'selected' : '' }}>
                    {{ $category }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Input Ikon Skill (Upload Widget) --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Icon</label>
        <button type="button" id="upload_widget_skill" class="mt-2 px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-500">
            Upload Icon
        </button>
        {{-- Input tersembunyi untuk menyimpan URL ikon --}}
        <input type="hidden" name="icon_url" id="icon_url" value="{{ old('icon_url', $skill->icon_url ?? '') }}">
        
        <div class="mt-4">
            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Current Icon:</p>
            @if(isset($skill) && $skill->icon_url)
                <img src="{{ $skill->icon_url }}" id="icon_preview" alt="Icon Preview" class="mt-2 h-16 w-16 bg-gray-200 p-1 rounded">
            @else
                <img src="https://via.placeholder.com/64" id="icon_preview" alt="Icon Preview" class="mt-2 h-16 w-16 bg-gray-200 p-1 rounded">
            @endif
        </div>
    </div>

    <div class="flex justify-end">
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
            {{-- Teks tombol akan otomatis berubah --}}
            {{ isset($skill) ? 'Update Skill' : 'Add Skill' }}
        </button>
    </div>
</div>

{{-- Script untuk Upload Widget --}}
@push('scripts')
<script src="https://upload-widget.cloudinary.com/global/all.js" type="text/javascript"></script>
<script type="text/javascript">
    const cloudName = "dex2f8xur"; 
    const uploadPreset = "portfolio_bagas";

    const skillWidget = cloudinary.createUploadWidget({
        cloudName: cloudName,
        uploadPreset: uploadPreset,
        folder: 'icons', // Ikon akan disimpan di folder 'icons'
        sources: ['local', 'url']
    }, (error, result) => { 
        if (!error && result && result.event === "success") { 
            const secureUrl = result.info.secure_url;
            document.getElementById('icon_url').value = secureUrl;
            document.getElementById('icon_preview').src = secureUrl;
        }
    });

    document.getElementById("upload_widget_skill").addEventListener("click", function(){
        skillWidget.open();
    }, false);
</script>
@endpush
