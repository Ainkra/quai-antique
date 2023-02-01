const images = document.querySelectorAll("img");

images.forEach(img => {
  img.addEventListener("mouseenter", function() {
    this.nextElementSibling.style.display = "block";
  });
  img.addEventListener("mouseleave", function() {
    this.nextElementSibling.style.display = "none";
  });
});