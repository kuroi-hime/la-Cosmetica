<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Models\Commande;

class Produit extends Model
{
    use HasSlug;
    
    protected $primaryKey = 'id_produit';

    protected $fillable = [
        'nom_produit',
        'description_produit',
        'stock_produit',
        'prix_produit',
        'slug_produit',
        'categorie_id',
    ];

    protected $hidden = [
        'categorie_id',
    ];

    /**
     * Get the product's category
     */
    public function category()
    {
        // 1. modèle lié. 2. sa clé étrangère 3. sa clé primaire
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    /**
     * Get all of the product's images.
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
	 * Get the options for generating the slug.
	 */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nom_produit')
            ->saveSlugsTo('slug_produit');
    }

    /**
     * Get the route key for the model (binding model).
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug_produit';
    }

    /**
     * 
     */
    public function commandes()
    {
        return $this->belongsToMany(
            Commande::class, 
            'commande_produit', 
            'commande_id', // Foreign key on pivot table for Commande
            'produit_id'   // Foreign key on pivot table for Produit
            )->using(CommandeProduit::class);
    }
}
