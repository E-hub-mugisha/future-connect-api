<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class AdminBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::all();
        return response()->json([
            'status' => true,
            'banners' => $banners
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'status' => 'nullable|in:active,inactive',
        ]);

        $banner = Banner::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'link' => $request->link,
            'status' => $request->status ?? 'active',
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Banner created successfully',
            'banner' => $banner
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $banner = Banner::find($id);

        if (!$banner) {
            return response()->json([
                'status' => false,
                'message' => 'Banner not found'
            ], 404);
        }

        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'status' => 'nullable|in:active,inactive',
        ]);

        $banner->update($request->only(['title', 'description', 'image', 'link', 'status']));

        return response()->json([
            'status' => true,
            'message' => 'Banner updated successfully',
            'banner' => $banner
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::find($id);

        if (!$banner) {
            return response()->json([
                'status' => false,
                'message' => 'Banner not found'
            ], 404);
        }

        $banner->delete();

        return response()->json([
            'status' => true,
            'message' => 'Banner deleted successfully'
        ]);
    }
}
