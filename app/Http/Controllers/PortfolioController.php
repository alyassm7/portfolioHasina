<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function about(): View
    {
        return view('about');
    }

    public function skills(): View
    {
        return view('skills', [
            'skills' => Skill::orderBy('order')->get(),
        ]);
    }

    public function projects(Request $request): View
    {
        $query = Project::orderBy('order');

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($tech = $request->get('tech')) {
            $query->whereJsonContains('technologies', $tech);
        }

        $allTechnologies = Project::all()
            ->flatMap(fn ($p) => $p->technologies ?? [])
            ->unique()
            ->sort()
            ->values();

        return view('projects', [
            'projects' => $query->get(),
            'allTechnologies' => $allTechnologies,
            'currentTech' => $tech ?? '',
            'search' => $search ?? '',
        ]);
    }

    public function experiences(): View
    {
        return view('experiences', [
            'experiences' => Experience::orderBy('order')->get(),
            'educations' => Education::orderBy('order')->get(),
        ]);
    }
}
