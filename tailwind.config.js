const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php'
    ],
    theme: {
        extend: {
          screens: {
            'xs': {'max': '639px'},
            'sm': {'min': '640px', 'max': '767px'},
            'md': {'min': '768px', 'max': '1023px'},
            'lg': {'min': '1024px'},
          },
        },
    },

    plugins: [require('@tailwindcss/forms'),
              require('@tailwindcss/typography'),
              require('tailwindcss-tables'),
              require('daisyui')],

    daisyui: {
        themes: ["night"],
    },
};
