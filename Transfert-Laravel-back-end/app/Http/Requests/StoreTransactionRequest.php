<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'montant' => 'required|numeric',
            'type_transaction' => 'required|string',
            'expediteur_id' => 'required|numeric',
            'destinataire_id' => 'required|numeric',
            'frais' => 'numeric|nullable',
            'permanent' => 'boolean|nullable',
            'date_transaction' => 'date|nullable'  
        ];
    }
}
