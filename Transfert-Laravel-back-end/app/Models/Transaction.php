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
    ];
    public function expediteur()
    {
        return $this->belongsTo(Client::class, 'expediteur_id');
    }
    public function destinataire()
    {
        return $this->belongsTo(Client::class, 'destinataire_id');
    }
}
