<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'skills' => Skill::orderBy('order')->get(),
            'projects' => Project::orderBy('order')->get(),
            'experiences' => Experience::orderBy('order')->get(),
            'educations' => Education::orderBy('order')->get(),
            'testimonials' => Testimonial::orderBy('order')->get(),
        ]);
    }

    public function downloadCv(): BinaryFileResponse
    {
        $path = Setting::get('cv_path');

        if (! $path || ! Storage::disk('public')->exists($path)) {
            abort(404, __('portfolio.messages.cv_unavailable'));
        }

        return response()->download(
            Storage::disk('public')->path($path),
            'CV Ralison Hasiniaina Aimée Samuëla.pdf'
        );
    }
}
