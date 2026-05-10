<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Photos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('admin.photos.create') }}"
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">
                            Upload Photo
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-gray-700">
                                    <th class="py-2">Image</th>
                                    <th class="py-2">Title/Description</th>
                                    <th class="py-2">Country</th>
                                    <th class="py-2">Featured</th>
                                    <th class="py-2 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($photos as $photo)
                                    <tr class="border-b border-gray-800">
                                        <td class="py-3">
                                            <img src="{{ Storage::url($photo->image_path) }}"
                                                class="w-16 h-16 object-cover rounded" alt="">
                                        </td>
                                        <td class="py-3">
                                            <div class="font-bold">{{ $photo->city }}</div>
                                            <div class="text-xs text-gray-400 truncate w-48">{{ $photo->description }}</div>
                                        </td>
                                        <td class="py-3">{{ $photo->country->name }}</td>
                                        <td class="py-3">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full {{ $photo->is_featured ? 'bg-yellow-500/20 text-yellow-500' : 'bg-gray-500/20 text-gray-500' }}">
                                                {{ $photo->is_featured ? 'Featured' : '-' }}
                                            </span>
                                        </td>
                                        <td class="py-3 text-right space-x-2">
                                            <a href="{{ route('admin.photos.edit', $photo) }}"
                                                class="text-blue-400 hover:text-blue-300">Edit</a>
                                            <form action="{{ route('admin.photos.destroy', $photo) }}" method="POST"
                                                class="inline-block" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-400 hover:text-red-300">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $photos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>