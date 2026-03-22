<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;
use App\Models\Commande;
use App\Models\CommandeProduit;
use App\Models\Produit;
use Tymon\JWTAuth\Facades\JWTAuth;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommandeRequest $request, string $slug)
    {
        // Récupération du produit par slug
        $produit = Produit::findBySlug($slug);

        // Vérification de la possiblité d'achat
        if($produit->stock_produit < $request->quantite)
            return response()->json(['message' => 'stock insufisant.']);

        // Token
        $user = JWTAuth::parseToken()->authenticate();
        
        // Création de la commande
        $commande = Commande::create([
            'adresse_livraison' => $request->adresse_livraison,
            'user_id' => $user->id,
        ]);

        // Commande <==> Produit
        CommandeProduit::create([
            'commande_id' => $commande->id_commande,
            'produit_id' => $produit->id_produit,
            'quantite_produit' => $request->quantite
        ]);

        // Déminuation du stock
        $produit->stock_produit -= $request->quantite;
        $produit->update([
            'stock_produit' => $produit->stock_produit
        ]);

        return response()->json([
            'message' => 'Commande en attente.',
            'commande' => $commande
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommandeRequest $request, Commande $commande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        //
    }
}
