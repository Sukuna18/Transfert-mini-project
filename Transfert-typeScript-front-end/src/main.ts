import {getCompte, getDestIdCompte, getExpIdCompte, getTransaction, transactionUrl } from "./components/API";
import {btnCode, codeDiv, codeReplace, codeText, destDiv, fournisseur, historique, iconeDest, iconeExp, montant, nomDest, nomExp, submit, telephoneDest, telephoneExp, transaction} from "./components/data";
import { handleColor, renderHeader, renderTransaction } from "./components/function";
import {Compte, Transaction} from "./components/interface";
import "./styles/style.css";
codeDiv.style.display = "none";
fournisseur.addEventListener("change", ():void => {
  handleColor(iconeExp, fournisseur);
  handleColor(iconeDest, fournisseur);
});
transaction.addEventListener("change", ():void => {
  destDiv.forEach((div: HTMLDivElement):void => {
    transaction.value == "Retrait" ? (div.style.display = "none") : (div.style.display = "block");
  }
  );
});
telephoneExp.addEventListener("change", async (): Promise<void> => {
  codeText.innerHTML = "";
  historique.innerHTML = "";
 renderHeader();
  const data:Compte = await getCompte(telephoneExp.value);
  if (telephoneExp.value == data.numero_client || telephoneExp.value == data.numero_compte) {
    nomExp.value = data.client;
  }

  let ExpId:number|undefined = await getExpIdCompte();  
  const dataTransaction: Transaction[] = await getTransaction(ExpId);
  dataTransaction.forEach((transaction: Transaction):void => {
   renderTransaction(transaction.type_transaction, transaction.montant, transaction.frais, transaction.date_transaction)
  }
  );

  
});
telephoneDest.addEventListener("change", async (): Promise<void> => {
  const data:Compte = await getCompte(telephoneDest.value);
    if (telephoneDest.value == data.numero_client || telephoneDest.value == data.numero_compte) {
      nomDest.value = data.client;
    }
});

submit.addEventListener("click", async (e: Event): Promise<void> => {
  e.preventDefault();
  if (telephoneExp.value == telephoneDest.value) {
    alert(
      "Le numero de telephone de l'expediteur ne doit pas etre le meme que celui du destinataire"
    );
    return;
  }
  const dataDest:Compte = await getCompte(telephoneDest.value);
  const dataExp:Compte = await getCompte(telephoneExp.value);
  if(transaction.value == "Depot" && dataDest.fournisseur != fournisseur.value){
    alert("Le destinataire doit avoir un compte chez le fournisseur choisi");
    return;
  }
  if(transaction.value != "Wari" && transaction.value != "Code"){
        if(dataExp.fournisseur != fournisseur.value || dataDest.fournisseur != fournisseur.value){
          alert("Le numero de telephone ne correspond pas au fournisseur choisi");
          return;
        }
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

btnCode.addEventListener("click", async (e:Event):Promise<void> => {
  e.preventDefault();
  const data:Transaction[] = await getTransaction(await getExpIdCompte());
  data.forEach((transaction: Transaction):void => {
      codeText.innerHTML = `${transaction.code}`;
  });
}
);

