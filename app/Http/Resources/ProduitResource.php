<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProduitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id_produit,
            'nom' => $this->nom_produit,
            'slug' => $this->slug_produit,
            'prix' => $this->prix_produit,
            'description' => $this->description_produit,
            'categorie' => $this->category->nom_categorie,
            'images' => $this->images->pluck('path'), // Liste des chemins d'images
        ];
    }
}
