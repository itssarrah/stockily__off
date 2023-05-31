"use strict";
//STICKY NAVIGATION :
window.onscroll = function () {
  myFunction();
};

// Get the navbar
var navbar = document.querySelector(".nav");

// Get the offset position of the navbar
var sticky = navbar.offsetTop;

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky");
  } else {
    navbar.classList.remove("sticky");
  }
}

// Get all the questions
const questions = document.querySelectorAll('.question');

// Loop through each question and attach a click event listener
questions.forEach(question => {
    question.addEventListener('click', () => {
        const answer = question.nextElementSibling;
        answer.classList.toggle('active');
    });
});

/*Search bar*/

// Get the search input, search button, and content container
const searchInput = document.getElementById('search-input');
const searchButton = document.getElementById('search-button');
const contentContainer = document.getElementById('content');

// Event listener for search button click
searchButton.addEventListener('click', performSearch);

// Function to perform search
function performSearch() {
  // Get the search query from the input field
  const query = searchInput.value.trim().toLowerCase();
  // Perform the search and scroll to the result
  scrollToResult(query);
}

// Function to perform search and scroll to the result
function scrollToResult(query) {
  // Get all the headings and paragraphs from the content container
  const elements = contentContainer.querySelectorAll('h1, h2, p');

  // Loop through the elements and check if they include the query
  for (let i = 0; i < elements.length; i++) {
    const element = elements[i];
    const text = element.innerText.trim().toLowerCase();

    if (text.includes(query)) {
      // Highlight the matched word
      const highlightedText = text.replace(
        new RegExp(`(${query})`, 'gi'),
        '<span class="highlight">$1</span>'
      );

      // Replace the element's content with the highlighted text
      element.innerHTML = highlightedText;

      // Scroll to the result element
      element.scrollIntoView({ behavior: 'smooth' });

      return; // Exit the loop after finding the first match
    }
  }

  // If no match is found, clear the search input
  searchInput.value = '';
}

