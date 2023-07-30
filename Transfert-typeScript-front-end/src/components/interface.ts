export interface Client {
    id: number;
    nomComplet: string;
    telephone: string;
} 
export interface Compte {
    id: number;
    montant: number;
    client_id: number;
    fournisseur: string;
    numero_compte: string|number;
    client: string;
    numero_client: string; 
}
export interface Transaction{
    id: number;
    montant: number;
    type_transaction: string;
    expediteur_id: number;
    destinataire_id: number;
    frais: number;
    code: string|undefined;
    permanent: boolean;
    date_transaction: string;
}