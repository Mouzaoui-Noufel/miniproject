<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index(Request $request)
    {
        $query = Film::with(['realisateur', 'acteurs'])
            ->withCount(['ratings', 'reviews'])
            ->withAvg('ratings', 'rating');

        // Search filters
        if ($request->has('titre')) {
            $query->where('titre', 'like', '%' . $request->input('titre') . '%');
        }
        if ($request->has('genre')) {
            $query->where('genres', 'like', '%' . $request->input('genre') . '%');
        }
        if ($request->has('acteur')) {
            $acteur = $request->input('acteur');
            $query->whereHas('acteurs', function ($q) use ($acteur) {
                $q->where('nom', 'like', '%' . $acteur . '%')
                  ->orWhere('prenom', 'like', '%' . $acteur . '%');
            });
        }

        // Pagination
        $films = $query->paginate(8);

        // Format the ratings_avg_rating as a float
        $films->getCollection()->transform(function ($film) {
            $film->ratings_avg_rating = $film->ratings_avg_rating ? (float) $film->ratings_avg_rating : 0;
            return $film;
        });

        return response()->json($films);
    }

    public function show($id)
    {
        $film = Film::with(['realisateur', 'acteurs'])
            ->withCount(['ratings', 'reviews'])
            ->withAvg('ratings', 'rating')
            ->findOrFail($id);

        // Format the ratings_avg_rating as a float
        $film->ratings_avg_rating = $film->ratings_avg_rating ? (float) $film->ratings_avg_rating : 0;

        // Get the authenticated user's rating and review if they exist
        if (auth()->check()) {
            $film->userRating = $film->ratings()
                ->where('user_id', auth()->id())
                ->first();
            
            $film->userReview = $film->reviews()
                ->where('user_id', auth()->id())
                ->first();

            $film->isFavorited = $film->favorites()
                ->where('user_id', auth()->id())
                ->exists();
        }

        // Get latest reviews with user information
        $film->latestReviews = $film->reviews()
            ->with('user:id,name')
            ->latest()
            ->take(5)
            ->get();

        return response()->json($film);
    }    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'resume' => 'nullable|string',
            'annee_sortie' => 'nullable|digits:4|integer',
            'duree' => 'nullable|integer',
            'genres' => 'nullable|string',
            'realisateur_id' => 'required|exists:realisateurs,id',
            'image_url' => 'nullable|url',
            'trailer_url' => 'nullable|url',
            'acteurs' => 'nullable|array',
            'acteurs.*.id' => 'exists:acteurs,id',
            'acteurs.*.role' => 'nullable|string',
        ]);

        $film = Film::create($validated);

        if (!empty($validated['acteurs'])) {
            $attachData = [];
            foreach ($validated['acteurs'] as $acteur) {
                $attachData[$acteur['id']] = ['role' => $acteur['role'] ?? null];
            }
            $film->acteurs()->attach($attachData);
        }

        return response()->json($film, 201);
    }

    public function update(Request $request, $id)
    {
        $film = Film::findOrFail($id);

        $validated = $request->validate([
            'titre' => 'sometimes|required|string|max:255',
            'resume' => 'nullable|string',
            'annee_sortie' => 'nullable|digits:4|integer',
            'duree' => 'nullable|integer',
            'genres' => 'nullable|string',
            'realisateur_id' => 'sometimes|required|exists:realisateurs,id',
            'acteurs' => 'nullable|array',
            'acteurs.*.id' => 'exists:acteurs,id',
            'acteurs.*.role' => 'nullable|string',
        ]);

        $film->update($validated);

        if (array_key_exists('acteurs', $validated)) {
            $attachData = [];
            foreach ($validated['acteurs'] as $acteur) {
                $attachData[$acteur['id']] = ['role' => $acteur['role'] ?? null];
            }
            $film->acteurs()->sync($attachData);
        }

        return response()->json($film);
    }

    public function destroy($id)
    {
        $film = Film::findOrFail($id);
        $film->acteurs()->detach();
        $film->delete();

        return response()->json(null, 204);
    }
}
