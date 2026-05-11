<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $photos = \App\Models\Photo::with('country')->where('is_featured', true)->latest()->get(); // Changed to explicit query for feature/latest if needed, or keeping it simple
        // Actually, let's keep it simple but maybe filter? The user "YA tengan mínimo un post subido" applies to the menu. The home usually shows everything or featured.
        // Let's stick to showing all on home for now, as per original code.
        $photos = \App\Models\Photo::with('country')->latest()->get();
        return view('home', compact('photos'));
    }

    public function gallery(\App\Models\Country $country)
    {
        $photos = $country->photos()->latest()->get();
        return view('gallery', compact('country', 'photos'));
    }

    public function galleries()
    {
        $countries = \App\Models\Country::where('active', true)->has('photos')->get();
        return view('galleries', compact('countries'));
    }

    public function latest()
    {
        $photos = \App\Models\Photo::with(['country', 'album'])->latest()->paginate(12);
        return view('latest', compact('photos'));
    }
}
