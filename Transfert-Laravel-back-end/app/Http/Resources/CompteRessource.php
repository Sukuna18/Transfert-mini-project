<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompteRessource extends JsonResource
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
            'numero_compte' => $this->numero_compte,
            'client_id' => $this->client_id,
            'fournisseur' => $this->fournisseur,
            'montant' => $this->montant,
            'client' => $this->client->nomComplet,
            'numero_client' => $this->client->telephone,
        ];
    }
}
