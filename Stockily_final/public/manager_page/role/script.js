"use strict";

const form = document.querySelector("form");
const chip = document.querySelector(".chip");
console.log(form, chip);

form.addEventListener("submit", (e) => {
  e.preventDefault();

  const emailInput = document.getElementById("email");
  const emailValue = emailInput.value;

  const newEmail = document.createElement("div");
  newEmail.classList.add("email");

  const emailAdress = document.createElement("div");
  emailAdress.classList.add("email__adress");
  emailAdress.textContent = emailValue;
  newEmail.appendChild(emailAdress);

  const deleteBtn = document.createElement("button");
  deleteBtn.classList.add("delete-btn");
  deleteBtn.innerHTML = `  
   <svg
     xmlns="http://www.w3.org/2000/svg"
     fill="none"
     background="none"
     viewBox="0 0 24 24"
     stroke-width="1.5"
     stroke="currentColor"
     class="w-6 h-6 email__icon"
   >
   <path
    stroke-linecap="round"
    stroke-linejoin="round"
    d="M6 18L18 6M6 6l12 12 email__icon"
   />
  </svg>`;

  newEmail.appendChild(deleteBtn);

  chip.appendChild(newEmail);

  emailInput.value = "";
  deleteBtn.addEventListener("click", () => {
    newEmail.remove();
  });
});
