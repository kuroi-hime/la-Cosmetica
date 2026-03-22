<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $primaryKey = 'id_commande';

    protected $fillable = [
        'adresse_livraison',
        'statut_commande',
        'user_id',
    ];

    protected $hidden = [
        'user_id',
    ];

    /**
     * Get the commande's owner
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 
     */
    public function products()
    {
        return $this->belongsToMany(Produit::class)->using(CommandeProduit::class);
    }
}
