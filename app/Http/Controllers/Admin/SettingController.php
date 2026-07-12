<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Support\LocaleContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings.edit', [
            'settings' => Setting::allForAdmin(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        foreach (Setting::translatableKeys() as $field) {
            if ($request->has($field.'_fr') || $request->has($field.'_en')) {
                Setting::set($field, LocaleContent::encode(
                    $request->input($field.'_fr', ''),
                    $request->input($field.'_en', '')
                ));
            }
        }

        $fields = [
            'site_name', 'hero_name', 'experience_years',
            'stat_projects', 'stat_commits', 'stat_technologies', 'stat_motivation',
            'github_url', 'linkedin_url', 'email', 'phone', 'meta_keywords',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                Setting::set($field, $request->input($field));
            }
        }

        if ($request->hasFile('about_photo')) {
            $stored = $request->file('about_photo')->store('images', 'public');
            Setting::set('about_photo', 'storage/'.$stored);
        }

        if ($request->hasFile('hero_photo')) {
            $stored = $request->file('hero_photo')->store('images', 'public');
            Setting::set('hero_photo', 'storage/'.$stored);
        }

        return back()->with('success', 'Paramètres mis à jour.');
    }

    public function uploadCv(Request $request): RedirectResponse
    {
        $request->validate(['cv' => 'required|file|mimes:pdf|max:5120']);

        $path = $request->file('cv')->store('cv', 'public');
        Setting::set('cv_path', $path);

        return back()->with('success', 'CV téléversé avec succès.');
    }
}
