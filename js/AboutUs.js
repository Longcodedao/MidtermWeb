if ($(window).width() > 870) {
  $(".owl-carousel").owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 3,
      },
    },
  });
} else {
  console.log("Helll");
  $(".owl-carousel").owlCarousel({
    center: true,
    item: 1,
    loop: true,
    margin: 10,
    nav: false,
    responsive: {
      200: {
        items: 1,
      },
    },
  });
}

var NavBar = document.getElementById("topnav");
var logo = document.getElementById("logo");
var navigate_options = document.getElementById("nav-option");
var sticky = NavBar.offsetTop;

if ($(window).width() > 960) {
  $(window).scroll(function () {
    if ($(window).scrollTop() > sticky + 100) {
      NavBar.classList.add("sticky");
      logo.classList.add("white-background");
      navigate_options.classList.add("white-background");
    } else {
      NavBar.classList.remove("sticky");
      logo.classList.remove("white-background");
      navigate_options.classList.remove("white-background");
    }
  });
}

$listNav = $("li.nav-opt");
console.log("Hello World");
$("#hamburger-icon").on("click", function () {
  var scrollPosition = $(window).scrollTop();
  localStorage.setItem("scrollPosition", scrollPosition);
  $listNav.slideToggle(200);
  var storedScrollPosition = localStorage.getItem("scrollPosition");
  $(window).scrollTop(storedScrollPosition);
  console.log($(window).scrollTop());
});

if ($("window").width() > 600) {
  $listNav.show();
}

// --working with keyframes--

const productWrapper = document.querySelector(".product-wrapper");
const textIntro = document.querySelector(".text-intro");

// define a function that checks if the element is in view
function isElementInViewport(element) {
  const windowHeight = window.innerHeight;
  let elementTop = element.getBoundingClientRect().top;
  let elementVisible = 30;

  if (elementTop < windowHeight - elementVisible) {
    return true;
  }
}

// define a function that toggles the animation class based on the scroll position
function toggleAnimationClass() {
  if (isElementInViewport(productWrapper)) {
    productWrapper.classList.add("slideright");
  } else {
    productWrapper.classList.remove("slideright");
  }
  if (isElementInViewport(textIntro)) {
    textIntro.classList.add("slideleft");
  } else {
    textIntro.classList.remove("slideleft");
  }
}

// add an event listener that calls the toggleAnimationClass function on scroll
window.addEventListener("scroll", toggleAnimationClass);
