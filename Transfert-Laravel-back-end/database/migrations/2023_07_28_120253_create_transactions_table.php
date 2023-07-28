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
            $table->float('frais');
            $table->unsignedBigInteger('destinataire_id');
            $table->unsignedBigInteger('expediteur_id');
            $table->dateTime('date_transaction')->useCurrent();
            $table->foreign('expediteur_id')->references('id')->on('comptes')->cascadeOnDelete();
            $table->foreign('destinataire_id')->references('id')->on('comptes')->cascadeOnDelete();
            $table->integer('code')->nullable();
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
