<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acteur extends Model
{
    use HasFactory;

    protected $table = 'acteurs';

    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'pays',
    ];

    public function films()
    {
        return $this->belongsToMany(Film::class, 'film_acteur')->withPivot('role');
    }
}
