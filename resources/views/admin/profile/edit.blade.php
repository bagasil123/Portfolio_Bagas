<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.profiles.store') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            {{-- Input teks --}}
                            <div>
                                <label for="name" class="block text-sm font-medium">Full Name</label>
                                <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md dark:bg-gray-700" value="{{ old('name', $profile->name) }}" required>
                            </div>
                            <div>
                                <label for="description_1" class="block text-sm font-medium">Description (Paragraph 1)</label>
                                <textarea name="description_1" id="description_1" rows="3" class="mt-1 block w-full rounded-md dark:bg-gray-700" required>{{ old('description_1', $profile->description_1) }}</textarea>
                            </div>
                            <div>
                                <label for="description_2" class="block text-sm font-medium">Description (Paragraph 2)</label>
                                <textarea name="description_2" id="description_2" rows="3" class="mt-1 block w-full rounded-md dark:bg-gray-700" required>{{ old('description_2', $profile->description_2) }}</textarea>
                            </div>
                             <div>
                                <label for="email" class="block text-sm font-medium">Email</label>
                                <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md dark:bg-gray-700" value="{{ old('email', $profile->email) }}" required>
                            </div>
                             <div>
                                <label for="instagram_url" class="block text-sm font-medium">Instagram URL</label>
                                <input type="url" name="instagram_url" id="instagram_url" class="mt-1 block w-full rounded-md dark:bg-gray-700" value="{{ old('instagram_url', $profile->instagram_url) }}" required>
                            </div>
                            <div>
                                <label for="location" class="block text-sm font-medium">Location</label>
                                <input type="text" name="location" id="location" class="mt-1 block w-full rounded-md dark:bg-gray-700" value="{{ old('location', $profile->location) }}" required>
                            </div>

                            {{-- BAGIAN UPLOAD WIDGET YANG DIPERBAIKI --}}
                            <div>
                                <label class="block text-sm font-medium">Profile Image</label>
                                <button type="button" id="upload_widget" class="mt-2 px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-500">
                                    Upload New Image
                                </button>
                                
                                {{-- PERBAIKAN 1: Beri nilai awal pada input tersembunyi --}}
                                <input type="hidden" name="profile_image_url" id="profile_image_url" value="{{ old('profile_image_url', $profile->profile_image_url) }}">
                                
                                <div class="mt-4">
                                    <p class="text-sm font-medium">Current Image:</p>
                                    {{-- PERBAIKAN 2: Logika untuk menampilkan gambar yang ada atau placeholder --}}
                                    @if($profile->profile_image_url)
                                        <img src="{{ $profile->profile_image_url }}" id="image_preview" alt="Image Preview" class="mt-2 h-32 w-32 rounded-full object-cover">
                                    @else
                                        <img src="https://via.placeholder.com/150" id="image_preview" alt="Image Preview" class="mt-2 h-32 w-32 rounded-full object-cover">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                                Save Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk Cloudinary Upload Widget --}}
    @push('scripts')
    <script src="https://upload-widget.cloudinary.com/global/all.js" type="text/javascript"></script>
    <script type="text/javascript">
        const cloudName = "dex2f8xur"; 
        const uploadPreset = "portfolio_bagas"; 

        const myWidget = cloudinary.createUploadWidget({
            cloudName: cloudName,
            uploadPreset: uploadPreset,
            folder: 'portfolio',
            cropping: true,
            sources: ['local', 'url', 'camera']
        }, (error, result) => { 
            if (!error && result && result.event === "success") { 
                const secureUrl = result.info.secure_url;
                document.getElementById('profile_image_url').value = secureUrl;
                document.getElementById('image_preview').src = secureUrl;
            }
        });

        document.getElementById("upload_widget").addEventListener("click", function(){
            myWidget.open();
        }, false);
    </script>
    @endpush
</x-app-layout>

