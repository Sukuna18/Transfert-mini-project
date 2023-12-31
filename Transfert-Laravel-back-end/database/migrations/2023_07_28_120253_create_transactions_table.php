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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('type_transaction');
            $table->integer('montant');
            $table->float('frais')->nullable();
            $table->string('code')->nullable();
            $table->dateTime('date_transaction')->useCurrent()->nullable();
            $table->foreignId('expediteur_id')->constrained('clients')->cascadeOnDelete();
            $table->foreignId('destinataire_id')->nullable()->constrained('clients')->cascadeOnDelete();
            $table->boolean('permanent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
