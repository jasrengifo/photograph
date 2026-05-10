<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($country) ? 'Edit Country' : 'Create Country' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form
                        action="{{ isset($country) ? route('admin.countries.update', $country) : route('admin.countries.store') }}"
                        method="POST">
                        @csrf
                        @if(isset($country))
                            @method('PUT')
                        @endif

                        <div class="mb-4">
                            <x-input-label for="name" value="Name" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name', $country->name ?? '')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="code" value="Code (ISO)" />
                            <x-text-input id="code" name="code" type="text" class="mt-1 block w-full"
                                :value="old('code', $country->code ?? '')" />
                            <x-input-error class="mt-2" :messages="$errors->get('code')" />
                        </div>

                        <div class="mb-4 flex items-center">
                            <input id="active" type="hidden" name="active" value="0">
                            <input id="active" type="checkbox" name="active" value="1"
                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                {{ old('active', $country->active ?? true) ? 'checked' : '' }}>
                            <label for="active"
                                class="ml-2 block text-sm text-gray-900 dark:text-gray-100">Active</label>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ isset($country) ? 'Update' : 'Create' }}</x-primary-button>
                            <a href="{{ route('admin.countries.index') }}"
                                class="text-gray-400 hover:text-gray-300">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>