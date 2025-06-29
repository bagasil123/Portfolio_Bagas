<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('category')->get();
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'icon_url' => 'nullable|url', // Diubah dari 'icon' menjadi 'icon_url'
            'category' => 'required|string',
        ]);

        if (!isset($validatedData['icon_url'])) {
            $validatedData['icon_url'] = '';
        }

        Skill::create($validatedData);

        return redirect()->route('admin.skills.index')->with('success', 'Skill added successfully.');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'icon_url' => 'nullable|url',
            'category' => 'required|string',
        ]);

        if (!$request->filled('icon_url')) {
            unset($validatedData['icon_url']);
        }

        $skill->update($validatedData);

        return redirect()->route('admin.skills.index')->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted successfully.');
    }
}
