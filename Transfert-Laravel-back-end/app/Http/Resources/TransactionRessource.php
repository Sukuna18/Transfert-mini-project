<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'montant' => $this->montant,
            'type_transaction' => $this->type_transaction,
            'expediteur_id' => $this->expediteur_id,
            'destinataire_id' => $this->destinataire_id,
            'frais' => $this->frais,
            'code' => $this->code,
            'permanent' => $this->permanent,
            'date_transaction' => $this->date_transaction,
        ];
    }
}
