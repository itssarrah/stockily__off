"use strict";
// //STICKY NAVIGATION :
// window.onscroll = function () {
//     myFunction();
// };

// // Get the navbar
// var navbar = document.querySelector(".nav");

// // Get the offset position of the navbar
// var sticky = navbar.offsetTop;

// // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
// function myFunction() {
//     if (window.pageYOffset >= sticky) {
//         navbar.classList.add("sticky");
//     } else {
//         navbar.classList.remove("sticky");
//     }
// }

/* login modal */

var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function () {
    modal.style.display = "block";
};

span.onclick = function () {
    modal.style.display = "none";
};

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};

function toggleMobileMenu(menu) {
    const cont = document.getElementById("main-container");
    menu.classList.toggle("open");
    if (menu.classList.contains("open")) {
        cont.style.marginTop = "40vh";
    } else {
        cont.style.marginTop = "100px";
    }
}
