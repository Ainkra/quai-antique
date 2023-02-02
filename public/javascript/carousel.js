const images = document.querySelectorAll('.grid > div');

images.forEach(image => {
  const hidden = image.querySelector('.hidden');
  if (!hidden) return;

  image.addEventListener('mouseenter', () => {
    hidden.style.display = 'block';
  });

  image.addEventListener('mouseleave', () => {
    hidden.style.display = 'none';
  });
});