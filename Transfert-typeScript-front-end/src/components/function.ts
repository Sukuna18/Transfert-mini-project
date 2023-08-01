import { historique } from "./data";

export function handleColor(
  element: HTMLHeadingElement,
  fournisseur: HTMLSelectElement
): void {
  if (fournisseur.value === "OrangeMoney") {
    element.style.backgroundColor = "#FD8D14";
    fournisseur.style.backgroundColor = "#FD8D14";
  } else if (fournisseur.value === "Wave") {
    element.style.backgroundColor = "blue";
    fournisseur.style.backgroundColor = "blue";
  } else if (fournisseur.value === "Wari") {
    element.style.backgroundColor = "green";
    fournisseur.style.backgroundColor = "green";
  } else {
    element.style.backgroundColor = "purple";
    fournisseur.style.backgroundColor = "purple";
  }
}

export function renderTransaction(type_transaction:string, montant:number, frais:number, date_transaction:string){
  let tbody = document.createElement("tbody");
    let tr: string  = `
    <tr class="border-b dark:border-neutral-500">
    <td class="whitespace-nowrap px-6 py-4 font-medium">${type_transaction}</td>
    <td class="whitespace-nowrap px-6 py-4">${montant}</td>
    <td class="whitespace-nowrap px-6 py-4">${frais}</td>
    <td class="whitespace-nowrap px-6 py-4">${date_transaction}</td>
  </tr>`
  tbody.innerHTML = tr;
    historique.appendChild(tbody);
}

export function renderHeader(): void{
  historique.innerHTML = `<thead class="border-b font-medium dark:border-neutral-500">
  <tr>
    <th scope="col" class="px-6 py-4">Type Transaction</th>
    <th scope="col" class="px-6 py-4">Montant</th>
    <th scope="col" class="px-6 py-4">Frais</th>
    <th scope="col" class="px-6 py-4">Date</th>
  </tr>
</thead>`
}