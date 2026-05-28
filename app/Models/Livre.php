<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'stock',
        'auteur_id',
        'categorie_id',
    ];

    public function auteur()
    {
        return $this->belongsTo(Auteur::class);
    }

    public function emprunts()
    {
        return $this->hasMany(Emprunt::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    public function avis()
    {
        return $this->hasMany(Avis::class);
    }
    public function favoris()
    {
        return $this->hasMany(Favori::class);
    }
}
