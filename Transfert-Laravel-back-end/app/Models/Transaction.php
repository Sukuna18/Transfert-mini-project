<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable = [
        'montant',
        'type_transaction',
        'expediteur_id',
        'destinataire_id',
        'frais',
        'permanent',
        'date_transaction'

    ];
    public function destinataire()
    {
        return $this->belongsTo(Compte::class, 'destinataire_id');
    }
    public function expediteur()
    {
        return $this->belongsTo(Compte::class, 'expediteur_id');
    }
}
