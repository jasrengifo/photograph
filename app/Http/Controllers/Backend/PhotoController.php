<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::with('country')->latest()->paginate(10);
        return view('admin.photos.index', compact('photos'));
    }

    public function create()
    {
        $countries = Country::where('active', true)->get();
        return view('admin.photos.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|max:2048', // 2MB max
            'album_id' => 'required|exists:albums,id',
            'country_id' => 'required|exists:countries,id',
            'city' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'description' => 'required|string',
            'author' => 'required|string|max:255',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('photos', 'public');
            $validated['image_path'] = $path;
        }

        $validated['user_id'] = auth()->id();
        $validated['is_featured'] = $request->boolean('is_featured'); // ensure boolean

        unset($validated['image']);

        Photo::create($validated);

        return redirect()->route('admin.photos.index')->with('success', 'Photo uploaded successfully.');
    }

    public function edit(Photo $photo)
    {
        $countries = Country::where('active', true)->get();
        return view('admin.photos.edit', compact('photo', 'countries'));
    }

    public function update(Request $request, Photo $photo)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|max:2048',
            'album_id' => 'required|exists:albums,id',
            'country_id' => 'required|exists:countries,id',
            'city' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'description' => 'required|string',
            'author' => 'required|string|max:255',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($photo->image_path) {
                Storage::disk('public')->delete($photo->image_path);
            }
            $path = $request->file('image')->store('photos', 'public');
            $validated['image_path'] = $path;
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        unset($validated['image']);

        $photo->update($validated);

        return redirect()->route('admin.photos.index')->with('success', 'Photo updated successfully.');
    }

    public function destroy(Photo $photo)
    {
        if ($photo->image_path) {
            Storage::disk('public')->delete($photo->image_path);
        }
        $photo->delete();
        return redirect()->route('admin.photos.index')->with('success', 'Photo deleted successfully.');
    }
}
