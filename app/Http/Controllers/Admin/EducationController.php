<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EducationController extends Controller
{
    public function index(): View
    {
        return view('admin.educations.index', [
            'educations' => Education::orderBy('order')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.educations.form', ['education' => new Education]);
    }

    public function store(Request $request): RedirectResponse
    {
        Education::create($this->validated($request));

        return redirect()->route('admin.educations.index')->with('success', 'Formation créée.');
    }

    public function edit(Education $education): View
    {
        return view('admin.educations.form', compact('education'));
    }

    public function update(Request $request, Education $education): RedirectResponse
    {
        $education->update($this->validated($request));

        return redirect()->route('admin.educations.index')->with('success', 'Formation mise à jour.');
    }

    public function destroy(Education $education): RedirectResponse
    {
        $education->delete();

        return redirect()->route('admin.educations.index')->with('success', 'Formation supprimée.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'institution' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'order' => 'integer|min:0',
        ]);
    }
}
