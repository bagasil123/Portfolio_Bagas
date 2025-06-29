<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image_url' => 'nullable|url', // Diubah dari 'image' menjadi 'image_url'
            'category' => 'required|string',
            'live_demo_url' => 'nullable|url',
            'source_code_url' => 'nullable|url',
            'tech_stack_description' => 'required|string',
        ]);

        // Jika tidak ada URL gambar baru saat membuat proyek, isi dengan string kosong
        if (!isset($validatedData['image_url'])) {
            $validatedData['image_url'] = '';
        }

        Project::create($validatedData);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image_url' => 'nullable|url',
            'category' => 'required|string',
            'live_demo_url' => 'nullable|url',
            'source_code_url' => 'nullable|url',
            'tech_stack_description' => 'required|string',
        ]);

        // Jika tidak ada URL gambar baru yang dikirim, jangan update kolom image_url
        if (!$request->filled('image_url')) {
            unset($validatedData['image_url']);
        }

        $project->update($validatedData);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}
