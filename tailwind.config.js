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
            keyframes: {
                title1: {
                    '15%, 100%, 0%': { 'font-variation-settings': '"wght" 400' },
                    '23%, 45%': { 'font-variation-settings': '"wght" 500' },
                    '53%, 92%': { 'font-variation-settings': '"wght" 600' },
                },
                title2: {
                    '15%, 100%, 0%': { 'font-variation-settings': '"wght" 500' },
                    '23%, 45%': { 'font-variation-settings': '"wght" 600' },
                    '53%, 92%': { 'font-variation-settings': '"wght" 400' },
                },
                title3: {
                    '15%, 100%, 0%': { 'font-variation-settings': '"wght" 600' },
                    '23%, 45%': { 'font-variation-settings': '"wght" 400' },
                    '53%, 92%': { 'font-variation-settings': '"wght" 500' },
                },
            },
            animation: {
                title1: 'title1 12s linear infinite',
                title2: 'title2 12s linear infinite',
                title3: 'title3 12s linear infinite',
            },
            colors: {
                neutral: {
                    100: '#EBF0F1',
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
                variable: ['DenimUprights'],
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
    ],
};
