/* Clientseitige Eingabepruefungen versandadresse.html */

console.log("validate.js geladen");

const form = document.getElementById("formular");

if (form !== null) {

  form.addEventListener("submit", function(e) {

    if (!pruefeEingabe()) {
      e.preventDefault();
    }

  });

}else{
  console.log("Fehler: Formular existiert nicht, Prüfung inaktiv.");
}

function setInputType(input) {
  let newRegex;
  switch (input.type) {

    case "text":

    newRegex = new RegExp("^([\u00C0-\u017Fa-zA-Z-]{2,}[ ]*[\u00C0-\u017Fa-zA-Z-]*)+$");

    if (input.id === "Adresszusatz") {
      newRegex = new RegExp("^[a-zA-Z0-9- ]*$");

    }else if (input.id === "Bic") {
      /* ISO 9362 */
      newRegex = new RegExp("^(([A-Z0-9]{4}[A-Z]{2}[A-Z0-9]{2})|([A-Z0-9]{4}[A-Z]{2}[A-Z0-9]{2}[A-Z0-9]{3}))$");

    }else if (input.id === "Iban") {
      /* ISO 13616 */
      newRegex = new RegExp("^[A-Z]{2}[0-9]{2}[a-zA-Z0-9]{16,30}$");
    }

    break;

    case "number":

    newRegex = new RegExp("^[1-9]+[0-9]*$");

    if(input.id === "Plz") {
      newRegex = new RegExp("^([0]{1}[1-9]{1}|[1-9]{1}[0-9]{1})[0-9]{3}$");

    }else if (input.id === "Telefonnummer") {
      newRegex = new RegExp("^[0-9]{4,}$");
    }

    break;

    default:

    newRegex = null;

    break;
  }
  return newRegex;
}

function pruefeEingabe() {

  console.log("call pruefeEingabe()");

  let regex;
  var onError = false;
  var errorListDebug = [];

  Array.from(form.elements).forEach((input) => {

    regex = setInputType(input);

    try{

      if((regex != null) && (regex.test(input.value) == false)) {
        throw{ stderr: input.id};
      }else{
        input.style.border = null;
        removeError(input);
      }

    }catch(e) {
      onError = true;
      input.setAttribute("style", "border:2px solid #ff0000;");
      errorListDebug.push(e.stderr);
      appendError(input);
    }

  });

  if (onError == false) {
    console.log("alles OK");
    return true;
  }

  console.log("onError = true");
  console.log("Fehler in Formularfeldern: "+errorListDebug);

  return false;
}

function removeError(input) {
  if (input.nextSibling != null && input.nextSibling.id == "stderr") {
    console.log("entferne Meldung von: "+input.id)
    input.nextSibling.remove();
  }
}

function appendError(inputField) {

  let error_dict = {
    Name: "Der Name besteht aus mindestens zwei Buchstaben.",
    Vorname: "Der Vorname besteht aus mindestens zwei Buchstaben.",
    Strasse: "Bitte geben Sie mindestens zwei Buchstaben ein.",
    Hausnummer: "Die Hausnummer muss aus einer ganzen Zahl bestehen. Weitere Angaben im Adresszusatz.",
    Adresszusatz: "Im Adresszusatz sind Zahlen, Buchstaben, Leerzeichen und '-' erlaubt.",
    Plz: "Geben Sie eine 5-stellige Postleitzahl an.",
    Wohnort:"Bitte geben Sie mindestens zwei Buchstaben ein.",
    Telefon: "Die Telefonnummer besteht aus mindestens 4 Zahlen.",
    Kontoinhaber: "Bitte geben Sie mindestens zwei Buchstaben ein.",
    Bic: "Geben Sie eine gültige 8 oder 11-stellige BIC an.",
    Iban: "Geben Sie eine gültige IBAN mit maximal 34 Zeichen an."
  }

  let newError = function () {
    let error_out = document.createElement("p");
    let error_msg;
    error_msg = error_dict[inputField.id];
    error_out.appendChild(document.createTextNode(error_msg));
    error_out.setAttribute("id", "stderr");
    error_out.setAttribute("class", "all_inclusiv");
    return error_out;
  };

  let insertErrorAfterInput = function (input, error) {
    if(input.nextSibling.id != "stderr") {
      input.parentNode.insertBefore(error, input.nextSibling);
    }
  };

  insertErrorAfterInput(inputField, newError());

}
