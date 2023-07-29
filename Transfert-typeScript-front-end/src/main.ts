import { getClient, getDestIdCompte, getExpIdCompte, transactionUrl } from "./components/API";
import {fournisseur, iconeDest, iconeExp, montant, nomDest, nomExp, submit, telephoneDest, telephoneExp, transaction} from "./components/data";
import { handleColor } from "./components/function";
import { Client} from "./components/interface";
import "./styles/style.css";



fournisseur.addEventListener("change", () => {
  handleColor(iconeExp, fournisseur);
  handleColor(iconeDest, fournisseur);
});
telephoneExp.addEventListener("change", async () => {
  const data:Client = await getClient(telephoneExp.value);
  if (telephoneExp.value == data.telephone && telephoneExp.value != telephoneDest.value) {
    nomExp.value = data.nomComplet;
  }
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
  const expId = await getExpIdCompte();
  const destId = await getDestIdCompte();
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
});

