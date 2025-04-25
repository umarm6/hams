import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            extend: {
                fontFamily: {
                    sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                },
            },
            screens: {
                '2xl': '1600px',
            },
            spacing: {
                '72': '18rem',
                '84': '21rem',
                '96': '24rem',
            },
            maxWidth: theme => {
                return {
                    'screen-2xl': theme('screens.2xl'),
                }
            },
        },
        variants: {
            opacity: ['responsive', 'hover', 'focus'],
        },
    },

    plugins: [forms],
};
