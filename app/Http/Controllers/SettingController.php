<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::orderBy('group')->orderBy('label')->get();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Get all settings from database
        $allSettings = Setting::all();

        foreach ($allSettings as $setting) {
            $key = $setting->key;

            // Handle file uploads for image settings
            if ($setting->type === 'image' && $request->hasFile("settings.{$key}")) {
                $file = $request->file("settings.{$key}");
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('settings', $filename, 'public');

                // Delete old file if exists
                if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                    Storage::disk('public')->delete($setting->value);
                }

                $setting->update(['value' => $path]);
            } else {
                // Handle non-image settings
                $value = $request->input("settings.{$key}");
                if ($value !== null && $setting->type !== 'image') {
                    $setting->update(['value' => $value]);
                }
            }
        }

        return back()->with('success', 'Settings updated successfully!');
    }
}
