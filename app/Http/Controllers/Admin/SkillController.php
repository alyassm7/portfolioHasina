<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SkillController extends Controller
{
    public function index(): View
    {
        return view('admin.skills.index', [
            'skills' => Skill::orderBy('order')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.skills.form', ['skill' => new Skill]);
    }

    public function store(Request $request): RedirectResponse
    {
        Skill::create($this->validated($request));

        return redirect()->route('admin.skills.index')->with('success', 'Compétence créée.');
    }

    public function edit(Skill $skill): View
    {
        return view('admin.skills.form', compact('skill'));
    }

    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $skill->update($this->validated($request));

        return redirect()->route('admin.skills.index')->with('success', 'Compétence mise à jour.');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();

        return redirect()->route('admin.skills.index')->with('success', 'Compétence supprimée.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
            'icon' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'order' => 'integer|min:0',
        ]);
    }
}
