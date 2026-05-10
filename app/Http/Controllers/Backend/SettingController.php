<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {
        // Simple key-value management. We display a form with all known settings.
        // If settings don't exist, we assume defaults or empty.
        $settings = DB::table('settings')->pluck('value', 'key');

        return view('admin.settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        // We expect an array of settings
        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            DB::table('settings')->updateOrInsert(
                ['key' => $key],
                ['value' => $value, 'updated_at' => now()]
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated.');
    }
}
