const a = [
    {
        name: "WM 2500",
        preis: "250",
        bild: "images/wm_2500.png",
        blaskraft: "8"
    },
    {
        name: "WM 50 Lite",
        preis: "100",
        bild: "images/wm_50_lite.png",
        blaskraft: "5"
    },
    {
        name: "WM super 300",
        preis: "500",
        bild: "images/wm_super_300.png",
        blaskraft: "20"
    }
]

const frame = document.querySelector(".produkte-frame");


function generateProductsOntoPage() {
    for (let i = 0; i < a.length; i++) {
        let link = document.createElement("a");
        link.classList.add("product-anchor");
        link.setAttribute("href","produktdetails.html");
        
        let box = document.createElement("div");
        box.classList.add("produkt-box");
        
        
        let name = document.createElement("p");
        name.classList.add("ps-name");
        let price = document.createElement("p");
        price.classList.add("ps-preis");
        let bild = document.createElement("img");

        name.innerHTML = a[i].name;
        price.innerHTML = "Preis: " + a[i].preis + "€";
        bild.setAttribute("src",a[i].bild);

        box.appendChild(bild);
        box.appendChild(name);
        box.appendChild(price);

        link.appendChild(box);

        frame.appendChild(link);

        console.log(name);
    }
}



function sortAufsteigend(attribut) {
    removeAllChildNodes(frame);

    if(attribut == "preis") {
        a.sort(function (b, c) {
            if (parseFloat(b.preis) < parseFloat(c.preis)) {
                return -1;
            }
            if (parseFloat(b.preis) > parseFloat(c.preis)) {
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
            if (parseFloat(b.preis) < parseFloat(c.preis)) {
                return 1;
            }
            if (parseFloat(b.preis) > parseFloat(c.preis)) {
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

const filter = document.querySelector(".filter-select");
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
