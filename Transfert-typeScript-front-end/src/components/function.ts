export function handleColor(
  element: HTMLHeadingElement,
  fournisseur: HTMLSelectElement
) {
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
