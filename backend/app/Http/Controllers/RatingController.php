<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Film;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Film $film)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5'
        ]);

        $rating = $film->ratings()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['rating' => $validated['rating']]
        );

        return response()->json($rating, 201);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        $film->ratings()->where('user_id', auth()->id())->delete();
        return response()->noContent();
    }

    public function getFilmRating(Film $film)
    {
        $rating = $film->ratings()->where('user_id', auth()->id())->first();
        $averageRating = $film->averageRating();
        
        return response()->json([
            'userRating' => $rating ? $rating->rating : null,
            'averageRating' => round($averageRating, 1),
            'totalRatings' => $film->ratings()->count()
        ]);
    }
}
