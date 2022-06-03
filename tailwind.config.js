const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                brown: {
                    50: '#fdf8f6',
                    100: '#f2e8e5',
                    200: '#eaddd7',
                    300: '#e0cec7',
                    400: '#d2bab0',
                    500: '#bfa094',
                    600: '#a18072',
                    700: '#977669',
                    800: '#846358',
                    900: '#43302b',
                },

                ochre: {
                    '50':  '#fcfaf6',
                    '100': '#faf0cc',
                    '200': '#f3da99',
                    '300': '#e2b365',
                    '400': '#cd873a',
                    '500': '#b36620',
                    '600': '#954c14',
                    '700': '#723912',
                    '800': '#4e270e',
                    '900': '#32180a',
                },

                sea: {
                    '50':  '#f6f9fa',
                    '100': '#e6f1f9',
                    '200': '#c7def3',
                    '300': '#9abde2',
                    '400': '#6997cb',
                    '500': '#5074b5',
                    '600': '#41589a',
                    '700': '#334278',
                    '800': '#242d53',
                    '900': '#151b34',
                },

            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                'xs': '.75rem',
                'sm': '.875rem',
                'tiny': '.875rem',
                'base': '1rem',
                'lg': '1.125rem',
                'xl': '1.25rem',
                '2xl': '1.5rem',
                '3xl': '1.875rem',
                '4xl': '2.25rem',
                '5xl': '3rem',
                '6xl': '4rem',
                '7xl': '5rem',
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
