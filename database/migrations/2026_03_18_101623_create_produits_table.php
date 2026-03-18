<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id('id_produit');
            $table->string('nom_produit');
            $table->text('description_produit');
            $table->integer('stock_produit');
            $table->decimal('prix_produit', 10, 2);
            $table->string('slug_produit')->unique()->after('nom_produit');
            $table->index('slug_produit');
            $table->foreignId('categorie_id')->constrained('categories', 'id_categorie');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
