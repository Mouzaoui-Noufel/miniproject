<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Film extends Model
{
    use HasFactory;

    protected $table = 'films';
 
    protected $fillable = [
        'titre',
        'resume',
        'annee_sortie',
        'duree',
        'genres',
        'realisateur_id',
        'image_url',
        'trailer_url'
    ];    public function realisateur()
    {
        return $this->belongsTo(Realisateur::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'film_id');
    }

    public function acteurs()
    {
        return $this->belongsToMany(Acteur::class, 'film_acteur')
            ->withPivot('role');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating') ?? 0;
    }
}
