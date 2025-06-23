<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\Category;
use App\Models\Talent;
use Illuminate\Support\Str;

class AdminStoryController extends Controller
{
    public function index()
{
    return response()->json([
        'stories' => Story::all(),
    ]);
}

public function show($id)
{
    return response()->json(Story::with(['talent', 'category'])->findOrFail($id));
}
public function create()
{
    $categories = Category::all();
    $talents = Talent::all();

    return response()->json([
        'categories' => $categories,
        'talents' => $talents,
    ]);
}
public function store(Request $request)
    {
        $validated = $request->validate([
    'talent_id' => 'required|exists:talents,id',
    'category_id' => 'required|exists:categories,id',
    'title' => 'required|string|max:255',
    'content' => 'nullable|string',
    'media' => 'nullable|string',
    'tags' => 'nullable|string',
    'status' => 'in:draft,published',
]);

$validated['slug'] = Str::slug($validated['title']);
        $story = Story::create($validated);
        return response()->json($story, 201);
    }

    public function edit($id)
{
    $story = Story::with(['category', 'talent'])->findOrFail($id);

    return response()->json([
        'story' => $story,
    ]);
}
    // Update a story
    public function update(Request $request, $id)
    {
        $story = Story::findOrFail($id);

        $validated = $request->validate([
    'talent_id' => 'required|exists:talents,id',
    'category_id' => 'required|exists:categories,id',
    'title' => 'required|string|max:255',
    'content' => 'nullable|string',
    'media' => 'nullable|string',
    'tags' => 'nullable|string',
    'status' => 'in:draft,published',
]);

$validated['slug'] = Str::slug($validated['title']);
        $story->update($validated);
        return response()->json($story);
    }

// Delete a story
    public function destroy($id)
    {
        $story = Story::findOrFail($id);
        $story->delete();

        return response()->json(['message' => 'Story deleted successfully.']);
    }
}
