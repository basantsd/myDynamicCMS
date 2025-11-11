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
        $settings = $request->input('settings', []);

        foreach ($settings as $key => $value) {
            $setting = Setting::where('key', $key)->first();

            if (!$setting) {
                continue;
            }

            // Handle file uploads for image settings
            if ($setting->type === 'image' && $request->hasFile("settings.{$key}")) {
                $file = $request->file("settings.{$key}");
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('settings', $filename, 'public');

                // Delete old file if exists
                if ($setting->value) {
                    Storage::disk('public')->delete($setting->value);
                }

                $value = $path;
            }

            $setting->update(['value' => $value]);
        }

        return back()->with('success', 'Settings updated successfully!');
    }
}
