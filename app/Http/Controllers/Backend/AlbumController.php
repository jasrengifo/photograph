<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::withCount('photos')->latest()->paginate(10);
        return view('admin.albums.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.albums.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('albums', 'public');
            $validated['cover_image_path'] = $path;
        }
        // Check for uniqueness of slug
        if (Album::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] .= '-' . uniqid();
        }

        Album::create($validated);

        return redirect()->route('admin.albums.index')->with('success', 'Album created successfully.');
    }

    public function edit(Album $album)
    {
        return view('admin.albums.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'active' => 'boolean',
        ]);

        $newSlug = Str::slug($validated['title']);
        if ($newSlug !== $album->slug) {
            if (Album::where('slug', $newSlug)->where('id', '!=', $album->id)->exists()) {
                $newSlug .= '-' . uniqid();
            }
            $validated['slug'] = $newSlug;
        }

        if ($request->hasFile('cover_image')) {
            if ($album->cover_image_path) {
                Storage::disk('public')->delete($album->cover_image_path);
            }
            $path = $request->file('cover_image')->store('albums', 'public');
            $validated['cover_image_path'] = $path;
        }

        $album->update($validated);

        return redirect()->route('admin.albums.index')->with('success', 'Album updated successfully.');
    }

    public function destroy(Album $album)
    {
        if ($album->cover_image_path) {
            Storage::disk('public')->delete($album->cover_image_path);
        }
        $album->delete();
        return redirect()->route('admin.albums.index')->with('success', 'Album deleted successfully.');
    }
}
