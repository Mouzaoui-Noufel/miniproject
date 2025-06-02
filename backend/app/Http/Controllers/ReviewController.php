<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Film;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Film $film)
    {
        \Log::info('Fetching reviews for film: ' . $film->id);
        
        $reviews = $film->reviews()
            ->with(['user:id,name,email'])
            ->latest()
            ->get()
            ->map(function ($review) {
                return [
                    'id' => $review->id,
                    'content' => $review->content,
                    'created_at' => $review->created_at,
                    'user_id' => $review->user_id,
                    'user' => [
                        'id' => $review->user->id,
                        'name' => $review->user->name
                    ]
                ];
            });
            
        \Log::info('Found reviews: ' . $reviews->count());
            
        return response()->json([
            'data' => $reviews,
            'message' => 'Reviews retrieved successfully'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Film $film)
    {
        // Validate the user is authenticated
        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $validated = $request->validate([
            'content' => 'required|string|min:3|max:1000'
        ]);

        // Check if user already has a review for this film
        $existingReview = $film->reviews()
            ->where('user_id', auth()->id())
            ->first();

        if ($existingReview) {
            return response()->json([
                'message' => 'You have already reviewed this movie'
            ], 400);
        }

        $review = $film->reviews()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content']
        ]);

        return response()->json($review->load('user:id,name'), 201);
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
    public function update(Request $request, Film $film, Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        $validated = $request->validate([
            'content' => 'required|string|min:3|max:1000'
        ]);

        $review->update($validated);
        return response()->json($review->load('user:id,name'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film, Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $review->delete();
        return response()->noContent();
    }

    public function getUserReview(Film $film)
    {
        $review = $film->reviews()
            ->where('user_id', auth()->id())
            ->first();
            
        return response()->json($review);
    }
}
