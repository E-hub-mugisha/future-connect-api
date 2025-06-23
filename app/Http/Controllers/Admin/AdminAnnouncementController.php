<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAnnouncementController extends Controller
{
    public function index()
    {
        return response()->json([
        'announcements' => Announcement::all(),
        'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'link' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $announcement = Announcement::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $request->image,
            'link' => $request->link,
            'is_active' => true,
            'category_id' => $request->category_id,
            'created_by' => 1,
        ]);

        return response()->json($announcement, 201);
    }

    public function show($id)
    {
        $announcement = Announcement::with('category')->findOrFail($id);
        return response()->json($announcement);
    }

    public function update(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'link' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'boolean'
        ]);

        $announcement->update($request->all());

        return response()->json($announcement);
    }

    public function destroy($id)
    {
        Announcement::findOrFail($id)->delete();
        return response()->json(['message' => 'Announcement deleted']);
    }
}
