<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    public function index(): View
    {
        return view('admin.experiences.index', [
            'experiences' => Experience::orderBy('order')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.experiences.form', ['experience' => new Experience]);
    }

    public function store(Request $request): RedirectResponse
    {
        Experience::create($this->validated($request));

        return redirect()->route('admin.experiences.index')->with('success', 'Expérience créée.');
    }

    public function edit(Experience $experience): View
    {
        return view('admin.experiences.form', compact('experience'));
    }

    public function update(Request $request, Experience $experience): RedirectResponse
    {
        $experience->update($this->validated($request));

        return redirect()->route('admin.experiences.index')->with('success', 'Expérience mise à jour.');
    }

    public function destroy(Experience $experience): RedirectResponse
    {
        $experience->delete();

        return redirect()->route('admin.experiences.index')->with('success', 'Expérience supprimée.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'year' => 'required|string|max:10',
            'title' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'integer|min:0',
        ]);
    }
}
