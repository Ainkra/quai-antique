/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    // Faire les chemins en préçisant les extensions pour que tailwind fonctionne.
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    screens: {
      // Gestion du responsive selon la taille d'écran
      'xs': '280px',
      'sm': '640px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1280px',
      '2xl': '1536px',
    }
  },
  plugins: [],
}
