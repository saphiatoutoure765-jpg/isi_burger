<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Burger extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prix',
        'image',
        'description',
        'stock',
        'archive',
    ];

    public function lignesCommande()
    {
        return $this->hasMany(LigneCommande::class);
    }
}
