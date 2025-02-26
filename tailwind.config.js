const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            backgroundImage: {
                close: 'var(--bg-close-url)',
            },
            colors: {
                neutral: {
                    100: '#EBF0F1',
                    300: '#D3D3D3',
                    500: '#666666',
                    700: '#222627',
                    800: '#171717',
                },
                red: {
                    500: '#F94D46',
                },
                blue: {
                    500: '#389ed8',
                },
            },
            fontFamily: {
                sans: ['Denim', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                '3xl': '2rem',
            },
            screens: {
                '3xl': '1920px',
            },
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
        require('@vueform/slider/tailwind'),
    ],
};
