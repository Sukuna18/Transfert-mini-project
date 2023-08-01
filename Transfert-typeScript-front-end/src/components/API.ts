import { telephoneExp, telephoneDest } from "./data";
import { Compte } from "./interface";

export const transactionUrl = "http://127.0.0.1:8000/api/transactions";
function compte(id: number|string): string {
  return `http://127.0.0.1:8000/api/comptes/transaction/${id}`
}
function transaction(id: number|string|undefined): string {
    return `http://127.0.0.1:8000/api/transactions/transaction/${id}`;
}
export async function getTransaction(id: number|undefined) {
    const response = await fetch(transaction(id));
    const result = await response.json();
    return result.data;
}
export async function getCompte(id: number|string) {
  if(id == "" || id == null) return;
    const response = await fetch(compte(id));
    const result = await response.json();
    return result.data;
}
export async function getExpIdCompte(): Promise<number|undefined> {
    const data: Compte = await getCompte(telephoneExp.value);
    if (data.numero_client == telephoneExp.value || data.numero_compte == telephoneExp.value) {
      return data.id;
    }
  }
export async function getDestIdCompte(): Promise<number|undefined> {
  if(telephoneDest.value == "" || telephoneDest.value == null) return;
    const data: Compte = await getCompte(telephoneDest.value);
    if (data.numero_client == telephoneDest.value || data.numero_compte == telephoneDest.value) {
      return data.id;
    }
  }