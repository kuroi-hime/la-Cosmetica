<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduitRequest;
use App\Http\Requests\UpdateProduitRequest;
use App\Models\Produit;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::with(['category', 'images'])->get()->toResourceCollection();

        return response()->json([
            'prouits' => $produits,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProduitRequest $request)
    {
        $produit = Produit::create($request->validated());

        return response()->json([
            'message' => 'Produit ajouté avec succés.',
            'produit' => $produit
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        $produit = Produit::findBySlug($produit->slug_produit)->toResource();

        return response()->json([
            'produit' => $produit,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProduitRequest $request, Produit $produit)
    {
        // il recherche automatiquement par slug
        $produit->update($request->validated());

        return response()->json([
            'message' => 'Produit mise à jour avec succés.',
            'produit' => $produit
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        $produit->commandes()->detach();
        
        $produit->delete();

        return response()->json([
            'message' => 'Produit supprimé avec succés.'
        ]);
    }
}
