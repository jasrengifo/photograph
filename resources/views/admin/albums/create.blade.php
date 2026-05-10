<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($album) ? 'Edit Album' : 'Create Album' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form
                        action="{{ isset($album) ? route('admin.albums.update', $album) : route('admin.albums.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($album))
                            @method('PUT')
                        @endif

                        <!-- Title -->
                        <div class="mb-4">
                            <x-input-label for="title" value="Title" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                :value="old('title', $album->title ?? '')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description" value="Description" />
                            <textarea id="description" name="description" rows="3"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description', $album->description ?? '') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <!-- Cover Image -->
                        <div class="mb-4">
                            <x-input-label for="cover_image" value="Cover Image" />
                            @if(isset($album) && $album->cover_image_path)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($album->cover_image_path) }}" alt="Preview"
                                        class="h-32 rounded object-cover">
                                </div>
                            @endif
                            <input id="cover_image" name="cover_image" type="file"
                                class="mt-1 block w-full text-gray-300" accept="image/*" />
                            <x-input-error class="mt-2" :messages="$errors->get('cover_image')" />
                        </div>

                        <!-- Active Toggle -->
                        <div class="mb-4 flex items-center">
                            <input id="active" type="hidden" name="active" value="0">
                            <input id="active" type="checkbox" name="active" value="1"
                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                {{ old('active', $album->active ?? true) ? 'checked' : '' }}>
                            <label for="active"
                                class="ml-2 block text-sm text-gray-900 dark:text-gray-100">Active</label>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ isset($album) ? 'Update' : 'Create' }}</x-primary-button>
                            <a href="{{ route('admin.albums.index') }}"
                                class="text-gray-400 hover:text-gray-300">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>