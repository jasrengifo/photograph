<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($photo) ? 'Edit Photo' : 'Upload Photo' }}
        </h2>
    </x-slot>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form
                        action="{{ isset($photo) ? route('admin.photos.update', $photo) : route('admin.photos.store') }}"
                        method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @csrf
                        @if(isset($photo))
                            @method('PUT')
                        @endif

                        <!-- Left Column: Details -->
                        <div class="space-y-4">
                            <div>
                                <x-input-label for="image" value="Image" />
                                <input type="file" name="image" id="image"
                                    class="mt-1 block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-gray-700 dark:file:text-gray-300"
                                    {{ isset($photo) ? '' : 'required' }}>
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                                @if(isset($photo) && $photo->image_path)
                                    <img src="{{ Storage::url($photo->image_path) }}" class="mt-2 w-32 h-auto rounded"
                                        alt="">
                                @endif
                            <div>
                                <x-input-label for="album_id" value="Album" />
                                <select name="album_id" id="album_id"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    required>
                                    <option value="">Select Album</option>
                                    @foreach(\App\Models\Album::where('active', true)->get() as $album)
                                        <option value="{{ $album->id }}" {{ old('album_id', $photo->album_id ?? '') == $album->id ? 'selected' : '' }}>{{ $album->title }}</option>
                                    @endforeach
                                </select>
                                <div class="mt-1 text-xs">
                                     <a href="{{ route('admin.albums.create') }}"
                                        class="text-indigo-400 hover:text-indigo-300" target="_blank">+ Add New Album</a>
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('album_id')" />
                            </div>

                            <div>
                                <x-input-label for="country_id" value="Country" />
                                <select name="country_id" id="country_id"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    required>
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ old('country_id', $photo->country_id ?? '') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <div class="mt-1 text-xs">
                                    <a href="{{ route('admin.countries.create') }}"
                                        class="text-indigo-400 hover:text-indigo-300" target="_blank">+ Add New
                                        Country</a>
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('country_id')" />
                            </div>

                            <div>
                                <x-input-label for="city" value="City / Location Name" />
                                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full"
                                    :value="old('city', $photo->city ?? '')" />
                                <x-input-error class="mt-2" :messages="$errors->get('city')" />
                            </div>

                            <div>
                                <x-input-label for="date" value="Date Taken" />
                                <x-text-input id="date" name="date" type="date" class="mt-1 block w-full"
                                    :value="old('date', isset($photo) && $photo->date ? $photo->date->format('Y-m-d') : '')" />
                                <x-input-error class="mt-2" :messages="$errors->get('date')" />
                            </div>

                            <div>
                                <x-input-label for="author" value="Author" />
                                <x-text-input id="author" name="author" type="text" class="mt-1 block w-full"
                                    :value="old('author', $photo->author ?? 'Ruth G.')" required />
                            </div>

                            <div class="flex items-center">
                                <input id="is_featured" type="hidden" name="is_featured" value="0">
                                <input id="is_featured" type="checkbox" name="is_featured" value="1"
                                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                    {{ old('is_featured', $photo->is_featured ?? false) ? 'checked' : '' }}>
                                <label for="is_featured"
                                    class="ml-2 block text-sm text-gray-900 dark:text-gray-100">Featured</label>
                            </div>
                        </div>

                        <!-- Right Column: Description & Map -->
                        <div class="space-y-4">
                            <div>
                                <x-input-label for="description" value="Description" />
                                <textarea name="description" id="description" rows="4"
                                    class="mt-1 block w-full rounded-md shadow-sm"
                                    placeholder="Photo details..."
                                    required>{{ old('description', $photo->description ?? '') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <div>
                                <x-input-label value="Location (Click on Map)" />
                                <div id="map" style="height: 500px;" class="w-full rounded-lg border border-gray-600 mt-1 z-0"></div>
                                <div class="grid grid-cols-2 gap-2 mt-2">
                                    <x-text-input id="latitude" name="latitude" type="text" placeholder="Lat"
                                        class="block w-full text-xs" :value="old('latitude', $photo->latitude ?? '')"
                                        readonly />
                                    <x-text-input id="longitude" name="longitude" type="text" placeholder="Lng"
                                        class="block w-full text-xs" :value="old('longitude', $photo->longitude ?? '')"
                                        readonly />
                                </div>
                            </div>
                        </div>

                        <div class="col-span-1 md:col-span-2 flex justify-end gap-4 mt-4">
                            <a href="{{ route('admin.photos.index') }}"
                                class="px-4 py-2 border border-gray-600 rounded text-gray-300 hover:text-white">Cancel</a>
                            <x-primary-button>{{ isset($photo) ? 'Update Photo' : 'Upload Photo' }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Default: Lisbon or existing coords
            var lat = {{ old('latitude', $photo->latitude ?? 38.7223) }};
            var lng = {{ old('longitude', $photo->longitude ?? -9.1393) }};
            var zoom = {{ isset($photo) && $photo->latitude ? 13 : 5 }};

            var map = L.map('map').setView([lat, lng], zoom);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            var marker;
            @if(isset($photo) && $photo->latitude)
                marker = L.marker([lat, lng]).addTo(map);
            @endif

            map.on('click', function (e) {
                if (marker) {
                    marker.setLatLng(e.latlng);
                } else {
                    marker = L.marker(e.latlng).addTo(map);
                }
                document.getElementById('latitude').value = e.latlng.lat;
                document.getElementById('longitude').value = e.latlng.lng;
            });

            // TomSelect for Country
            new TomSelect("#country_id",{
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });

            // TomSelect for Album
            new TomSelect("#album_id",{
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });
    </script>
</x-app-layout>