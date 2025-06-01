<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realisateur extends Model
{
    use HasFactory;

    protected $table = 'realisateurs';

    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'pays',
    ];

    public function films()
    {
        return $this->hasMany(Film::class);
    }
}
