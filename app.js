const hamburger = document.querySelector(".hamburger");
const nav = document.querySelector("nav");
const h1 = document.querySelector("#hr-1");
const h2 = document.querySelector("#hr-2");
const h3 = document.querySelector("#hr-3");

console.log(hamburger,nav);

hamburger.addEventListener("click", () => {
    nav.classList.toggle("nav-active");
    h2.classList.toggle("hr2-active");
    h1.classList.toggle("hr-active");
    h3.classList.toggle("hr-active");
    h1.classList.toggle("hr1-active");
    h3.classList.toggle("hr3-active");

});
