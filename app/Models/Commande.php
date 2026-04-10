<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'statut',
        'montant_total',
        'date_paiement',
        'montant_paiement',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);   //Une commande appartient a un seul client
    }

    public function lignesCommande()
    {
        return $this->hasMany(LigneCommande::class);// une commande a plusieurs lignes
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class);//une commande ne peut avoir qu'un seul paiement
    }
}
