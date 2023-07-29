import { telephoneExp, telephoneDest } from "./data";
import { Compte } from "./interface";

export const transactionUrl = "http://127.0.0.1:8000/api/transactions";
export function compte(id: number|string) {
  return `http://127.0.0.1:8000/api/comptes/transaction/${id}`
}
export function client(id: number|string) {
    return `http://127.0.0.1:8000/api/clients/transaction/${id}`
}
export async function getClient(id: number|string) {
    const response = await fetch(client(id));
    const result = await response.json();
    console.log(result.data);
    return result.data;
}
export async function getCompte(id: number|string) {
    const response = await fetch(compte(id));
    const result = await response.json();
    console.log(result.data);
    
    return result.data;
}
export async function getExpIdCompte() {
    const data: Compte = await getCompte(telephoneExp.value);
    if (data.numero_client == telephoneExp.value) {
      return data.id;
    }
  }
export async function getDestIdCompte() {
    const data: Compte = await getCompte(telephoneDest.value);
    if (data.numero_client == telephoneDest.value) {
      return data.id;
    }
  }