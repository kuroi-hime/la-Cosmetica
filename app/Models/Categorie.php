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
     * 
     */
    public function products()
    {
        return $this->hasMany(Produit::class, 'id_produit');
    }
}
