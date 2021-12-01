
    const uname = document.getElementById("name");
    const bestnr = document.getElementById("bestnr");
    const kommentar = document.getElementById("kommentar");
    const form = document.getElementById("formular");
    const errorElement = document.getElementById("error");
    
    form.addEventListener("submit", (e) =>{
        let msg = [];

        unameNoSpace = uname.value.trim()
        if(unameNoSpace === "" || unameNoSpace == null){
            msg.push("Anonyme Rezension.")
            /*Für eine leere Eingabe soll als Verfasser Anonym gespeichert werden. Serverseitig?*/
        }else if(unameNoSpace.length<3){
            msg.push("Name zu kurz!");
        }

        /* Nicht nötig da in HTML bereits geprüft!*/
        if(bestnr.value<0 || bestnr.value.length!=3){
            msg.push("Gib eine gültige (3-stellige) Bestellnummer ein!")
        }

        if(msg.length > 0){
            e.preventDefault();
            errorElement.innerText = msg.join("\n");
        }
    })