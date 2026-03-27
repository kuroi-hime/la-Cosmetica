<?php

namespace Tests\Feature;

use App\Models\Categorie;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategorieTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_admin_can_add_categorie(): void
    {
        $adminRole = Role::create(['nom_role' => 'admin']);
        $admin = User::factory()->create(['role_id' => $adminRole->id_role]);
        $token = auth('api')->login($admin);

        $nom_categorie = $this->faker->sentence;
        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->postJson('/api/categories',[
            'nom_categorie' => $nom_categorie
        ]);

        // vérifier le nom de catégorie retourné dans l'api
        $response->assertStatus(201)->assertJsonPath('categorie.nom_categorie', $nom_categorie);

        // vérifier la persistance des données dans la base de données de test
        $this->assertDatabaseHas('categories', ['nom_categorie' => $nom_categorie]);
    }

    /**
     * 
     */
    public function test_admin_can_edit_categorie(): void
    {
        $adminRole = Role::create(['nom_role'=>'admin']);
        $admin = User::factory()->create(['role_id'=>$adminRole->id_role]);
        $token = auth('api')->login($admin);
        $nom_categorie = $this->faker->sentence;
        $categorie = Categorie::create(['nom_categorie'=>$nom_categorie]);

        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->patchJson("/api/categories/{$categorie->id_categorie}", [
                            "nom_categorie" => "{$nom_categorie} xxx"
                        ]);
        $response->assertStatus(200)->assertJsonPath('categorie.nom_categorie', "{$nom_categorie} xxx");

        $this->assertDatabaseHas('categories', ['nom_categorie' => "{$nom_categorie} xxx"]);
    }

    /**
     * 
     */
    public function test_admin_can_delete_categorie(): void
    {
        $adminRole = Role::create(['nom_role'=>'admin']);
        $admin = User::factory()->create(['role_id'=>$adminRole->id_role]);
        $token = auth('api')->login($admin);
        $categorie = Categorie::create(['nom_categorie' => $this->faker->word]);

        $response = $this->withHeader('Authorization', "Bearer {$token}")
                         ->deleteJson("/api/categories/{$categorie->id_categorie}");

        $response->assertStatus(200);

        // Vérification dans base de données
        $this->assertDatabaseMissing('categories', [
            'id_categorie' => $categorie->id_categorie
        ]);
    }
}
