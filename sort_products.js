
const a = [];
fetch("products.json")
    .then(response => response.json())
    .then(data => {
        for (let i=0; i<data.length; i++) {
            a.push(data[i])
        }
        loadpage()
    }
);

function loadpage() {

    const frame = document.querySelector(".produkte-frame");

    function generateProductsOntoPage() {
        for (let i = 0; i < a.length; i++) {
            let link = document.createElement("a");
            link.classList.add("product-anchor");
            link.setAttribute("href","produktdetails.php?id="+a[i].produktID);
    
            let box = document.createElement("div");
            box.classList.add("produkt-box");
    
    
            let name = document.createElement("p");
            name.classList.add("ps-name");
            let price = document.createElement("p");
            price.classList.add("ps-preis");
            let bild = document.createElement("img");
            let bk = document.createElement("p");
            bk.classList.add("blaskraft_id");
    
            name.innerHTML = a[i].modell;
            price.innerHTML = "Preis: " + a[i].nettopreis + "€";
            bk.innerHTML = a[i].blaskraft + "N";
            bild.setAttribute("src",a[i].produktbild);
    
            box.appendChild(bild);
            box.appendChild(name);
            box.appendChild(price);
            box.appendChild(bk);
    
            link.appendChild(box);
    
            frame.appendChild(link);
    
        }
    }
    
    
    
    function sortAufsteigend(attribut) {
        removeAllChildNodes(frame);
    
        if(attribut == "preis") {
            a.sort(function (b, c) {
                if (parseFloat(b.nettopreis) < parseFloat(c.nettopreis)) {
                    return -1;
                }
                if (parseFloat(b.nettopreis) > parseFloat(c.nettopreis)) {
                    return 1;
                }
                return 0;
            });
        }
        else {
            a.sort(function (b, c) {
                if (parseFloat(b.blaskraft) < parseFloat(c.blaskraft)) {
                    return -1;
                }
                if (parseFloat(b.blaskraft) > parseFloat(c.blaskraft)) {
                    return 1;
                }
                return 0;
            });
        }
    
        generateProductsOntoPage();
    }
    
    
    function sortAbsteigend(attribut) {
        removeAllChildNodes(frame);
    
        if(attribut == "preis") {
            a.sort(function (b, c) {
                if (parseFloat(b.nettopreis) < parseFloat(c.nettopreis)) {
                    return 1;
                }
                if (parseFloat(b.nettopreis) > parseFloat(c.nettopreis)) {
                    return -1;
                }
                return 0;
            });
        }
        else {
            a.sort(function (b, c) {
                if (parseFloat(b.blaskraft) < parseFloat(c.blaskraft)) {
                    return 1;
                }
                if (parseFloat(b.blaskraft) > parseFloat(c.blaskraft)) {
                    return -1;
                }
                return 0;
            });
        }
    
        generateProductsOntoPage();
    }
    
    
    function removeAllChildNodes(parent) {
        while (parent.firstChild) {
            parent.removeChild(parent.firstChild);
        }
    }
    
    
    sortAufsteigend("preis");
    
    const filter = document.querySelector(".sort-select");
    filter.addEventListener("change", function() {
        if(filter.value == "Preis aufsteigend") {
            sortAufsteigend("preis");
        }
        else if(filter.value == "Preis absteigend") {
            sortAbsteigend("preis");
        }
        else if (filter.value == "Blaskraft aufsteigend") {
            sortAufsteigend("blaskraft");
        }
        else {
            sortAbsteigend("blaskraft");
        }
    
    });
    
}
