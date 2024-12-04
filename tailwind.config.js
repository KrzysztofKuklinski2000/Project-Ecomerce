/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/templates/**/*.php",      // Szukaj klas w plikach PHP w katalogu resources
    "./resources/**/*.html",     // Szukaj klas w plikach HTML w katalogu resources
    "./resources/**/*.js",       // Jeśli używasz plików JavaScript, także je uwzględnij
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

