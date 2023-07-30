import { getClient, getDestIdCompte, getExpIdCompte, getTransaction, transactionUrl } from "./components/API";
import {btnCode, codeDiv, codeReplace, codeText, destDiv, fournisseur, historique, iconeDest, iconeExp, montant, nomDest, nomExp, submit, telephoneDest, telephoneExp, transaction} from "./components/data";
import { handleColor, renderHeader, renderTransaction } from "./components/function";
import { Client, Transaction} from "./components/interface";
import "./styles/style.css";
codeDiv.style.display = "none";
fournisseur.addEventListener("change", () => {
  handleColor(iconeExp, fournisseur);
  handleColor(iconeDest, fournisseur);
});
transaction.addEventListener("change", () => {
  destDiv.forEach((div: HTMLDivElement) => {
    transaction.value == "Retrait" ? (div.style.display = "none") : (div.style.display = "block");
  }
  );
});
telephoneExp.addEventListener("change", async () => {
  codeText.innerHTML = "";
  historique.innerHTML = "";
 renderHeader();
  const data:Client = await getClient(telephoneExp.value);
  if (telephoneExp.value == data.telephone && telephoneExp.value != telephoneDest.value) {
    nomExp.value = data.nomComplet;
  }
  let ExpId = await getExpIdCompte();
  const dataTransaction: Transaction[] = await getTransaction(ExpId);
  dataTransaction.forEach((transaction: Transaction) => {
   renderTransaction(transaction.type_transaction, transaction.montant, transaction.frais, transaction.date_transaction)
  }
  );

  
});
telephoneDest.addEventListener("change", async () => {
  const data:Client = await getClient(telephoneDest.value);
  if (telephoneDest.value == data.telephone && telephoneDest.value != telephoneExp.value) {
    nomDest.value = data.nomComplet;
  }
  });

submit.addEventListener("click", async (e: Event) => {
  e.preventDefault();
  if (telephoneExp.value == telephoneDest.value) {
    alert(
      "Le numero de telephone de l'expediteur ne doit pas etre le meme que celui du destinataire"
    );
    return;
  }
  const expId:number|undefined = await getExpIdCompte();
  const destId: number|undefined = await getDestIdCompte();
  let data = {
    montant: montant.value,
    type_transaction: transaction.value,
    expediteur_id: expId,
    destinataire_id: destId,
    frais: 0,
    permanent: false,
    date_transaction: new Date().toISOString(),
  };
  let request = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  };
  const response = await fetch(transactionUrl, request);
  console.log(response);
  if(transaction.value == "Code"){
    codeDiv.style.display = "block";
    codeReplace.style.display = "none";
  }
});

btnCode.addEventListener("click", async (e:Event) => {
  e.preventDefault();
  const data:Transaction[] = await getTransaction(await getExpIdCompte());
  data.forEach((transaction: Transaction) => {
      codeText.innerHTML = `${transaction.code}`;
  });
}
);

