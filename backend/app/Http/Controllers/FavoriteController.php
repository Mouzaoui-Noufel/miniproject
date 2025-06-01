<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Film;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favorites = auth()->user()->favorites()
            ->with(['film' => function ($query) {
                $query->with(['realisateur', 'acteurs'])
                    ->withCount(['ratings', 'reviews'])
                    ->withAvg('ratings', 'rating');
            }])
            ->latest()
            ->paginate(12);

        // Format the ratings_avg_rating as a float for each film
        $favorites->getCollection()->transform(function ($favorite) {
            if ($favorite->film) {
                $favorite->film->ratings_avg_rating = $favorite->film->ratings_avg_rating ? (float) $favorite->film->ratings_avg_rating : 0;
                // Add isFavorited flag since we know these are favorites
                $favorite->film->isFavorited = true;
            }
            return $favorite;
        });
            
        return response()->json($favorites);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Film $film)
    {
        $favorite = $film->favorites()->firstOrCreate([
            'user_id' => auth()->id()
        ]);

        return response()->json($favorite, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        $film->favorites()
            ->where('user_id', auth()->id())
            ->delete();
            
        return response()->noContent();
    }

    /**
     * Check if the film is favorited by the authenticated user.
     */
    public function check(Film $film)
    {
        $isFavorited = $film->favorites()
            ->where('user_id', auth()->id())
            ->exists();
            
        return response()->json(['favorited' => $isFavorited]);
    }
}
