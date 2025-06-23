<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Talent;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminTalentController extends Controller
{
    public function index()
    {
        return response()->json([
        'talents' => Talent::all(),
        'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'skill' => 'required|string',
            'story' => 'nullable|string',
            'rating' => 'nullable|integer|min:0|max:5',
            'featured' => 'boolean',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'language' => 'nullable|string',
        ]);

        $talent = Talent::create($request->all());
        return response()->json($talent, 201);
    }

    public function show($id)
    {
        return Talent::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $talent = Talent::findOrFail($id);
        $talent->update($request->all());
        return response()->json($talent);
    }

    public function destroy($id)
    {
        $talent = Talent::findOrFail($id);
        $talent->delete();
        return response()->json(['message' => 'Talent deleted successfully']);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $talent = Talent::findOrFail($id);
        $talent->status = $request->status;
        $talent->save();

        return response()->json(['message' => 'Status updated successfully']);
    }
}
