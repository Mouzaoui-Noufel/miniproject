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
        $reviews = $film->reviews()
            ->with('user:id,name')
            ->latest()
            ->paginate(10);
            
        return response()->json($reviews);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Film $film)
    {
        $validated = $request->validate([
            'content' => 'required|string|min:3|max:1000'
        ]);

        $review = $film->reviews()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['content' => $validated['content']]
        );

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
        $this->authorize('update', $review);
        
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
        $this->authorize('delete', $review);
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
