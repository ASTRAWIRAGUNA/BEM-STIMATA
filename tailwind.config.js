import tailwindcss from 'tailwindcss';

export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
    theme: {
      fontFamily: {
        'inter': ["'Poppins'", 'sans-serif']
      },
    },
    plugins: [tailwindcss],
};
