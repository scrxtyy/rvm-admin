const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    darkMode: "class",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js",
        "./src/**/*.{html,js}", 
        "./node_modules/tw-elements/dist/js/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                dark: {
                    bg: "#151823",
                    "eval-1": "#222738",
                    "eval-2": "#2A2F42",
                    "eval-3": "#2C3142",
                },
            },
        },
    },
    plugins: [require("@tailwindcss/forms"),
        require('tw-elements/dist/plugin')],

    // content: ['./src/**/*.{html,js}', './node_modules/tw-elements/dist/js/**/*.js'],
    
    // plugins: [require('tw-elements/dist/plugin')]
      
};

// module.exports = {
//     content: ['./src/**/*.{html,js}', './node_modules/tw-elements/dist/js/**/*.js'],
//     plugins: [
//       require('tw-elements/dist/plugin')
//     ]
//   }