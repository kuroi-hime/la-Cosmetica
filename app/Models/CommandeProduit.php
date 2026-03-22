<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CommandeProduit extends Pivot
{
    protected $table = 'commande_produit';

    protected $primaryKey = ['commande_id', 'produit_id'];

    protected $fillable = [
        'commande_id',
        'produit_id',
        'quantite_produit',
    ];
}
