<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Skill') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.skills.update', $skill) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('admin.skills._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

---
<!-- File: resources/views/admin/skills/_form.blade.php (Partial Form) -->
<div class="space-y-6">
    <div>
        <label for="name" class="block text-sm font-medium">Skill Name</label>
        <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md dark:bg-gray-700" value="{{ old('name', $skill->name ?? '') }}" required>
    </div>
    
    <div>
        <label for="category" class="block text-sm font-medium">Category</label>
        <select name="category" id="category" class="mt-1 block w-full rounded-md dark:bg-gray-700" required>
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

    <div>
        <label for="icon" class="block text-sm font-medium">Icon</label>
        <input type="file" name="icon" id="icon" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
        @if(isset($skill) && $skill->icon_url)
            <p class="mt-1 text-xs text-gray-500">Leave blank if you don't want to change the icon.</p>
            <img src="{{ $skill->icon_url }}" alt="Current Icon" class="mt-2 h-16 w-16 bg-gray-200 p-1 rounded">
        @endif
    </div>

    <div class="flex justify-end">
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
            {{ isset($skill) ? 'Update Skill' : 'Add Skill' }}
        </button>
    </div>
</div>
