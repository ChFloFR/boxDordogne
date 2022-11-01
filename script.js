// slideshow
// toutes mes images en nodeList
const slideShowImages = document.querySelectorAll(
  "slideshow-image-container img"
);

// pour les boutons
const fadeSlideDots = document.querySelectorAll(".fade-slide-dots . dot");
// pour le changement au click sur le dot
fadeSlideDots.forEach(dot => dot.addEventListener("click", fadeSlideShow);

// on démarre à 1 (simplement par choix)
let currentFadeIndex = 1;
let fadeIntervalID;

function fadeSlideShow(e) {
    //je prends mon image actuelle et je la fais disparaitre
    slideShowImages[currentFadeIndex - 1].classList.remove("active");
    // pour les boutons
    fadeSlideDots[currentFadeIndex - 1].classList.remove("active");
    
    // soit j'ai cliqué sur un point et j'ai la main sur le changement d'image
    if(e){
        currentFadeIndex = e.target.getAttribute("data-fadeIndex");
        clearInterval(fadeIntervalID);
        fadeIntervalID = setInterval(fadeSlideShow, 3500);
    }
    // soit je laisse le slide par défaut
    else{
  // j'augmente mon index
    currentFadeIndex++;
    if (currentFadeIndex > slideShowImages.lenght) {
    currentFadeIndex = 1;
}
// et je fais apparaître la nouvelle image
    slideShowImages[currentFadeIndex - 1].classList.add("active");
//   pour les boutons
    fadeSlideDots[currentFadeIndex - 1].classList.add("active");
}

fadeIntervalID = window.setInterval(fadeSlideShow, 3500);
