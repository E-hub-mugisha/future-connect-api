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
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        return response()->json([
            'talents' => Talent::with('talent'),
            'categories' => Category::all(),
            'stories' => \App\Models\Story::all(),
            'skills' => \App\Models\Skill::with('talent'),
            'testimonials' => \App\Models\Testimonial::with('talent')->inRandomOrder()->take(2)->get(),
        ]);
    }
    public function show($id)
    {
        $talent = Talent::with(['skills', 'stories'])->findOrFail($id);
        return response()->json($talent);
    }
    public function getTalentByCategory($slug)
    {
        // Find the category by slug or fail
        $category = Category::where('slug', $slug)->firstOrFail();

        // Fetch talents with related talent
        $talents = Talent::where('category_id', $category->id)
            ->get();

        return response()->json([
            'categoryName' => $category->name,
            'talents' => $talents,
        ]);
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

    public function random()
    {
        return Testimonial::with('talent')->inRandomOrder()->take(2)->get();
    }

    public function getByCategory($slug)
    {
        // Find the category by slug or fail
        $category = Category::where('slug', $slug)->firstOrFail();

        // Fetch skills with related talent
        $skills = Skill::with('talent')
            ->where('category_id', $category->id)
            ->get();

        return response()->json([
            'categoryName' => $category->name,
            'skills' => $skills,
        ]);
    }
    public function getStoryByCategory($slug)
    {
        // Find the category by slug or fail
        $category = Category::where('slug', $slug)->firstOrFail();

        // Fetch stories with related talent
        $stories = Story::where('category_id', $category->id)
            ->get();

        return response()->json([
            'categoryName' => $category->name,
            'stories' => $stories,
        ]);
    }
    public function skillDetails($slug)
    {
        $skill = \App\Models\Skill::where('slug', $slug)->firstOrFail();
        return response()->json($skill);
    }
    public function relatedSkills($categoryId)
    {
        $excludeId = request()->query('exclude');

        $query = Skill::with(['category', 'talent'])
            ->where('category_id', $categoryId);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        $skills = $query->latest()->take(6)->get();

        return response()->json([
            'skills' => $skills
        ]);
    }
    public function withTalentCount()
    {
        $categories = Category::withCount('talents')->get();

        return response()->json($categories);
    }
}
