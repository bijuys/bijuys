<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Show form to edit site settings.
     */
    public function edit()
    {
        $settings = Setting::getAll();
        $bioImageUrl = Setting::getBioImageUrl();
        return view('admin.settings', compact('settings', 'bioImageUrl'));
    }

    /**
     * Update site settings and bio image.
     */
    public function update(Request $request)
    {
        $request->validate([
            'bio_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif,svg', 'max:5120'],
            'site_name' => ['nullable', 'string', 'max:255'],
            'owner_name' => ['nullable', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email', 'max:255'],
        ], [
            'bio_image.image' => 'The uploaded bio photo must be an image (JPEG, PNG, WebP, GIF, or SVG).',
            'bio_image.max' => 'The bio picture size cannot exceed 5MB.',
        ]);

        // Handle Bio Image Upload
        if ($request->hasFile('bio_image')) {
            $currentBio = Setting::get('bio_image');
            if ($currentBio && !str_starts_with($currentBio, 'http') && Storage::disk('public')->exists($currentBio)) {
                if ($currentBio !== 'bio/biju-yohannan.svg') {
                    Storage::disk('public')->delete($currentBio);
                }
            }
            $path = $request->file('bio_image')->store('bio', 'public');
            Setting::set('bio_image', $path);
        } elseif ($request->boolean('remove_bio_image')) {
            $currentBio = Setting::get('bio_image');
            if ($currentBio && !str_starts_with($currentBio, 'http') && Storage::disk('public')->exists($currentBio)) {
                if ($currentBio !== 'bio/biju-yohannan.svg') {
                    Storage::disk('public')->delete($currentBio);
                }
            }
            Setting::set('bio_image', 'bio/biju-yohannan.svg');
        }

        $allowedKeys = [
            'site_name',
            'owner_name',
            'owner_title',
            'hero_badge',
            'hero_title',
            'hero_subtitle',
            'stat_experience',
            'stat_projects',
            'stat_satisfaction',
            'about_lead',
            'about_bio_1',
            'about_bio_2',
            'about_bio_3',
            'location',
            'availability',
            'contact_email',
            'contact_phone',
            'github_url',
            'linkedin_url',
            'twitter_url',
        ];

        foreach ($allowedKeys as $key) {
            if ($request->has($key)) {
                Setting::set($key, $request->input($key));
            }
        }

        return redirect()->route('admin.settings.edit')
            ->with('success', 'Site content and bio picture updated successfully!');
    }
}
