<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Site Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.settings.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Contact Info -->
                        <h3 class="text-lg font-medium text-gray-300 border-b border-gray-700 pb-2">Contact Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="contact_email" value="Contact Email" />
                                <x-text-input id="contact_email" name="contact_email" type="email"
                                    class="mt-1 block w-full" :value="$settings['contact_email'] ?? 'hello@portfolio.com'" />
                            </div>
                            <div>
                                <x-input-label for="contact_location" value="Location Text" />
                                <x-text-input id="contact_location" name="contact_location" type="text"
                                    class="mt-1 block w-full" :value="$settings['contact_location'] ?? 'Lisbon, Portugal'" />
                            </div>
                        </div>

                        <!-- Home Page Texts -->
                        <h3 class="text-lg font-medium text-gray-300 border-b border-gray-700 pb-2 pt-4">Home Page
                            Content</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="home_subtitle" value="Badge / Subtitle" />
                                <x-text-input id="home_subtitle" name="home_subtitle" type="text" class="mt-1 block w-full"
                                    :value="$settings['home_subtitle'] ?? 'Selected Works ' . date('Y')" />
                                <p class="text-xs text-gray-400 mt-1">Small text above title</p>
                            </div>
                            <div>
                                <!-- Empty column for spacing or future use -->
                            </div>
                            <div>
                                <x-input-label for="home_title_1" value="Title Part 1 (Bold)" />
                                <x-text-input id="home_title_1" name="home_title_1" type="text"
                                    class="mt-1 block w-full" :value="$settings['home_title_1'] ?? 'Capturing'" />
                            </div>
                            <div>
                                <x-input-label for="home_title_2" value="Title Part 2 (Italic)" />
                                <x-text-input id="home_title_2" name="home_title_2" type="text"
                                    class="mt-1 block w-full" :value="$settings['home_title_2'] ?? 'The Unseen'" />
                            </div>
                        </div>
                        <div>
                            <x-input-label for="home_description" value="Main Description" />
                            <textarea name="home_description" id="home_description" rows="3"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ $settings['home_description'] ?? 'Exploring the boundaries between light and shadow...' }}</textarea>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save Settings') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>