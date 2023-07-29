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