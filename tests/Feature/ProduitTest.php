<?php

namespace Tests\Feature;

use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProduitTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_get_produit_par_slug(): void
    {
        $categorie = Categorie::create(['nom_categorie'=>'cvc']);
        $produit = Produit::create(['nom_produit'=>$this->faker->sentence, 
                                    'description_produit'=>$this->faker->words(20, true),
                                    'stock_produit'=>random_int(10,100),
                                    'prix_produit'=>0.01*random_int(10, 1000),
                                    'categorie_id'=>$categorie->id_categorie]);

        $response = $this->getJson("/api/produits/{$produit->slug_produit}");

        $response->assertStatus(200)
                 ->assertJsonPath('produit.slug', $produit->slug_produit);
    }
}
