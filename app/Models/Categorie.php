<?php

namespace App\Models;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $primaryKey = 'id_categorie';

    protected $fillable = [
        'nom_categorie',
    ];

    /**
     * Get the products for the current category
     */
    public function products()
    {
        return $this->hasMany(Produit::class, 'id_produit');
    }
}
