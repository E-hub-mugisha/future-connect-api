<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Talent;
use App\Models\Category;
use App\Models\Skill;
use App\Models\SkillReview;
use App\Models\Story;
use App\Models\StoryComment;

class HomeController extends Controller
{
    public function index()
    {
        return response()->json([
            'talents' => Talent::all(),
            'categories' => Category::all(),
            'stories' => \App\Models\Story::all(),
            'skills' => \App\Models\Skill::all(),
        ]);
    }
    public function show($id)
    {
        $talent = Talent::findOrFail($id);
        return response()->json($talent);
    }
    public function TalentSkillDetails($id)
    {
        $skill = \App\Models\Skill::with('reviews')->findOrFail($id);
        return response()->json($skill);
    }
    public function storeReview(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string',
        ]);

        $data['skill_id'] = $id;

        $review = SkillReview::create($data);

        return response()->json(['message' => 'Review submitted successfully', 'review' => $review]);
    }
    // Store a new comment for a story
    public function storeStoryComment(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'comment' => 'required|string',
            'story_id' => 'required|exists:stories,id',
        ]);

        $comment = StoryComment::create($data);

        return response()->json($comment, 201);
    }
    public function storeTalent(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'skill' => 'required|string',
            'story' => 'nullable|string',
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
    public function storyDetails($slug)
    {
        $story = \App\Models\Story::where('slug', $slug)->with('comments')->firstOrFail();
        return response()->json($story);
    }
    
}
