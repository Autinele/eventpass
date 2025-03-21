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
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
        $table->text('description');
        $table->datetime('date_debut');
        $table->datetime('date_fin');
        $table->enum('statut', ['actif', 'expiré'])->default('actif');
        $table->integer('limite_participants');
    $table->integer('participants_count')->default(0); 
        $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evenements');
    }
};
