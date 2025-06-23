<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

class AdminSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = \App\Models\Category::all();
        $talents = \App\Models\Talent::all();
        return response()->json([
            'skills' => Skill::all(),
            'categories' => $categories,
            'talents' => $talents,
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:skills,name',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'talent_id' => 'required|exists:talents,id',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'level' => 'required|in:beginner,intermediate,advanced',
        ]);
        $validatedData['slug'] = \Illuminate\Support\Str::slug($validatedData['name']);
        $skill = Skill::create($validatedData);
        return response()->json($skill, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return response()->json(Skill::with(['talent', 'category'])->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $skill = Skill::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:skills,name,' . $skill->id,
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'talent_id' => 'required|exists:talents,id',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'level' => 'required|in:beginner,intermediate,advanced',
        ]);
        $validatedData['slug'] = \Illuminate\Support\Str::slug($validatedData['name']);
        $skill->update($validatedData);
        return response()->json($skill, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $skill = Skill::findOrFail($id);
        $skill->delete();
        return response()->json(['message' => 'Skill deleted successfully'], 200);
    }
}
