<?php

namespace Database\Seeders;

use App\Models\Produit;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Produit::create([
            'nom_produit' => fake()->words(2, true), // true pour joindre les mots par un espace => false : retourne un tableau de string
            'description_produit' => fake()->paragraph(),
            'stock_produit' => random_int(0, 100),// le 100 est tenu en compte
            'prix_produit' => fake()->randomFloat(2, 1, 500),
            'categorie_id' => 1, 
        ]);

        Produit::create([
            'nom_produit' => fake()->words(2, true), // true pour joindre les mots par un espace => false : retourne un tableau de string
            'description_produit' => fake()->paragraph(),
            'stock_produit' => random_int(0, 100),
            'prix_produit' => fake()->randomFloat(2, 1, 500),
            'categorie_id' => 2, 
        ]);

        Produit::create([
            'nom_produit' => fake()->words(2, true), // true pour joindre les mots par un espace => false : retourne un tableau de string
            'description_produit' => fake()->paragraph(),
            'stock_produit' => random_int(0, 100),
            'prix_produit' => fake()->randomFloat(2, 1, 500),
            'categorie_id' => 2, 
        ]);
    }
}
