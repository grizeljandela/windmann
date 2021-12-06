const a = [
    {
        name: "WM 2500",
        preis: "250",
        bild: "images/wm_2500.JPG",
        blaskraft: "8"
    },
    {
        name: "WM 50 Lite",
        preis: "100",
        bild: "images/wm_50_lite.jpg",
        blaskraft: "5"
    },
    {
        name: "WM super 300",
        preis: "500",
        bild: "images/wm_super_300.JPG",
        blaskraft: "20"
    },
    {
        name: "WM 1000",
        preis: "150",
        bild: "images/wm_1000.jpg",
        blaskraft: "21"
    },
    {
        name: "WM 2600",
        preis: "320",
        bild: "images/wm_2600.JPG",
        blaskraft: "9"
    },
    {
        name: "WM Super 22",
        preis: "600",
        bild: "images/wm_super_22.JPG",
        blaskraft: "15"
    },
    {
        name: "WM 55 Lite",
        preis: "50",
        bild: "images/wm_55_lite.JPG",
        blaskraft: "25"
    },
    {
        name: "WM Super 121",
        preis: "800",
        bild: "images/wm_super_121.JPG",
        blaskraft: "10"
    },
    {
        name: "WM 1111",
        preis: "1150",
        bild: "images/wm_1111.JPG",
        blaskraft: "22"
    },
    {
        name: "WM 8000",
        preis: "1000",
        bild: "images/wm_8000.JPG",
        blaskraft: "30"
    }
];

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
        let bk = document.createElement("p");
        bk.classList.add("blaskraft_id");

        name.innerHTML = a[i].name;
        price.innerHTML = "Preis: " + a[i].preis + "€";
        bk.innerHTML = a[i].blaskraft + "N";
        bild.setAttribute("src",a[i].bild);

        box.appendChild(bild);
        box.appendChild(name);
        box.appendChild(price);
        box.appendChild(bk);

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
