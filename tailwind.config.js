/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                neutral: {
                    100: '#EBF0F1',
                    800: '#171717',
                },
                red: {
                    500: '#F94D46',
                },
            },
        },
    },
    plugins: [],
};
