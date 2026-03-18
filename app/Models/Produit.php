<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

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

}
