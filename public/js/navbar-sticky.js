// Navbar stick on scroll ++ styles

var navbar = document.querySelector("[navbar-main]");

window.onscroll = function () {
  let blur = navbar.getAttribute("navbar-scroll");
  if (blur == "true") stickyNav();
};

function stickyNav() {
  if (window.scrollY >= 5) {
    navbar.classList.add("backdrop-saturate-[200%]", "backdrop-blur-[30px]", "bg-[hsla(0,0%,100%,0.8)]", "shadow-blur");
  } else {
    navbar.classList.remove("backdrop-saturate-[200%]", "backdrop-blur-[30px]", "bg-[hsla(0,0%,100%,0.8)]", "shadow-blur");
  }
}
