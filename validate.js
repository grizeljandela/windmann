/* Clientseitige Eingabepruefungen versandadresse.html */

console.log("validate.js geladen");

const form = document.getElementById("formular");

form.addEventListener("submit", (e) => {

  if (!pruefeEingabe()) {
    e.preventDefault();
  }

});

function pruefeEingabe() {

  console.log("call pruefeEingabe()");


  if (form != null) {

    var regex;
    var onError = false;
    var errorListDebug = [];

    Array.from(form.elements).forEach((input) => {

      switch (input.type) {

        case "text":

        regex = new RegExp("^[a-zA-Z- ]{4,}$");

        if (input.id === "Adresszusatz") {
          regex = new RegExp("^[a-zA-Z0-9- ]+$");

        }else if (input.id === "BIC") {
          /* ISO 9362 */
          regex = new RegExp("^(([A-Z0-9]{4}[A-Z]{2}[A-Z0-9]{2})|([A-Z0-9]{4}[A-Z]{2}[A-Z0-9]{2}[A-Z0-9]{3}))$");

        }else if (input.id === "IBAN") {
          /* ISO 13616 */
          regex = new RegExp("^[A-Z]{2}[0-9]{2}[a-zA-Z0-9]{16,30}$");
        }

        break;

        case "number":

        regex = new RegExp("^[0-9]*$");

        if(input.id === "PLZ") {
          regex = new RegExp("^([0]{1}[1-9]{1}|[1-9]{1}[0-9]{1})[0-9]{3}$");
    
        }else if (input.id === "Telefonnumer") {
          regex = new RegExp("^[0-9]{8,}$");
        }

        break;

        default:

        regex = null;

        break;
      }

      try{

        if((regex != null) && (regex.test(input.value) == false)) {
          throw{ stderr: input.id};
        }else{
          input.style.border = null;
        }

      }catch(e) {
        onError = true;
        input.setAttribute("style", "border:2px solid #ff0000;");
        errorListDebug.push(e.stderr);
      }

    });

    if (onError == false) {
      console.log("alles OK");
      return true;
    }


  }else{
    console.log("FEHLER: form ist null");
  }
  console.log("onError = true");
  console.log("Fehler in Formularfeldern: "+errorListDebug);

  appendError();

  return false;
}

function appendError() {

  let error_out = document.createElement("p");

  error_out.appendChild(document.createTextNode("Bitte beheben Sie die markierten Fehler im Formular."));

  error_out.setAttribute("style", "color: red; padding-top: 20px;");

  error_out.setAttribute("id", "stderr");
  error_out.setAttribute("class", "all_inclusiv");

  if (document.getElementById("stderr") == null) {

    document.getElementsByClassName("all_inclusiv")[0].appendChild(error_out);

  }
}
