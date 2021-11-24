/* Clientseitige Eingabepruefungen */

console.log("validate.js geladen");

function pruefeEingabe() {

  console.log("pruefeEingabe()");

  const form = document.getElementById("formular")

  if (form != null) {

    var regex;
    var onError = false;

    /* Iteriere durch alle input-Elemente*/
    Array.from(form.elements).forEach((input) => {

      switch (input.type) {

        case "text":
        /* leer ("") wird schon im html gerprüft*/
        regex = new RegExp("^[a-zA-Z- ]+$");
        /* von Anfang an a-z A-Z, wobei diese mind 1. mal vorkommen müssen */

        if (input.id === "Adresszusatz") {
          regex = new RegExp("^[a-zA-Z0-9- ]+$");

        }else if (input.id === "BIC") {
          /* Wikipedia ISO_9362 */
          regex = new RegExp("^(([A-Z0-9]{4}[A-Z]{2}[A-Z0-9]{2})|([A-Z0-9]{4}[A-Z]{2}[A-Z0-9]{2}[A-Z0-9]{3}))$");

        }else if (input.id === "IBAN") {
          /* ISO  ISO 13616 */
          regex = new RegExp("^[A-Z]{2}[0-9]{2}[a-zA-Z0-9]{16,30}$");
        }
        break;

        case "number":
        regex = new RegExp("^[0-9]*$");
        /*Am Anfang dezimal 0-beliebiger Länge, dazwischen 0-9 und am Ende wieder 0-beliebig*/

        if(input.id === "PLZ") {
          regex = new RegExp("^([0]{1}[1-9]{1}|[1-9]{1}[0-9]{1})[0-9]{3}$");
          /* (von Anfang an 01 oder 10) und 0-9 3 mal*/
        }else if (input.id === "Telefonnumer") {
          regex = new RegExp("^[0-9]{8,}$");
        }
        break;

        /*Wir nehmen nur die HTML5-Prüfung
        case "email":
        regex = new RegExp("^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$");
        break;*/

        default:
        regex = null;
        console.log(input.id+": unbehandeltes Eingabefeld");
        break;
      }

      try{
        if((regex != null) && (regex.test(input.value) == false)) {
          throw{ stderr: "enthält ungültige Zeichen"};
        }else{
          input.style.border = null;
        }

      }catch(e) {
        onError = true;
        input.setAttribute("style", "border:2px solid #ff0000;");
        console.log(input.id+": "+e.stderr);
      }

    });

    if (onError == false) {
      console.log("onError: "+onError);
      return true;
    }


  }else{
    console.log("FEHLER: form ist null");
  }
  console.log("onError: "+onError);

  appendError();

  return false;
}

function appendError() {

  let error_out = document.createElement("p");

  error_out.appendChild(document.createTextNode("Bitte beheben Sie die Fehler im Formular."));

  error_out.setAttribute("style", "color: red; padding-top: 20px;");

  error_out.setAttribute("id", "stderr");
  error_out.setAttribute("class", "versand_input");

  if (document.getElementById("stderr") == null) {

    document.getElementsByClassName("all_inclusiv")[0].appendChild(error_out);

  }
}
