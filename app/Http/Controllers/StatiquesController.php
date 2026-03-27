<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Http\Request;

class StatiquesController extends Controller
{
    /**
     * Counting sales.
     */
    public function ventes(Request $request)
    {
        $ventes = DB::table('produits')
                        ->join('commande_produit', 'id_produit', '=', 'produit_id')
                        ->join('commandes', 'commande_id', '=', 'id_commande')
                        ->where('statut_commande', 'livrée')
                        ->select('produits.*')
                        ->selectRaw('sum(quantite_produit) as nbrVentes')
                        ->groupBy('id_produit')
                        ->orderByRaw('nbrVentes desc');

        if($request->filled('offset'))
            $ventes = $ventes->offset($request->offset);

        if($request->filled('limit'))
            $ventes = $ventes->limit($request->limit);

        // $ventes = Produit::withCount('commandes as nbrVentes')->orderBy('nbrVentes', 'desc')->get();

        return  response()->json([
            'ventes' => $ventes->get()
        ]);
    }

    /**
     * 
     */
    public function populaires(Request $request)
    {
        $produits_populaires = DB::table('commandes')
                                   ->leftjoin('commande_produit', 'id_commande', '=', 'commande_id')
                                   ->leftjoin('produits', 'produit_id', '=', 'id_produit')
                                   ->selectRaw('produits.*, sum(quantite_produit) as nbrProduits')
                                   ->groupByRaw('id_produit') // Pour utiliser de multiple group by =>groupByRaw
                                   ->orderByRaw('nbrProduits desc');

        if($request->filled('offset'))
            $produits_populaires = $produits_populaires->offset($request->offset);
        
        if($request->filled('limit'))
            $produits_populaires = $produits_populaires->limit($request->limit);

        return response()->json([
            'produits populaires' => $produits_populaires->get()
        ]);
    }

    /**
     * 
     */
    public function produitsParCategorie(Request $request)
    {
        $produits_categories = DB::table('categories')
                                   ->rightJoin('produits', 'id_categorie', '=', 'categorie_id')
                                   ->select('categories.*')
                                   ->selectRaw('count(id_produit) as nbrProduits')
                                   ->groupBy('id_categorie')
                                   ->get();
        
        return response()->json(['produits' => $produits_categories]);
    }
}
