<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Countries') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('admin.countries.create') }}"
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">
                            Add New Country
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-gray-700">
                                <th class="py-2">Name</th>
                                <th class="py-2">Code</th>
                                <th class="py-2">Active</th>
                                <th class="py-2 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($countries as $country)
                                <tr class="border-b border-gray-800">
                                    <td class="py-3">{{ $country->name }}</td>
                                    <td class="py-3">{{ $country->code }}</td>
                                    <td class="py-3">
                                        <span
                                            class="px-2 py-1 text-xs rounded-full {{ $country->active ? 'bg-green-500/20 text-green-500' : 'bg-red-500/20 text-red-500' }}">
                                            {{ $country->active ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-right space-x-2">
                                        <a href="{{ route('admin.countries.edit', $country) }}"
                                            class="text-blue-400 hover:text-blue-300">Edit</a>
                                        <form action="{{ route('admin.countries.destroy', $country) }}" method="POST"
                                            class="inline-block" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $countries->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>