import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Outfit', ...defaultTheme.fontFamily.sans],
                serif: ['Lora', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                sinau: {
                    dark: '#2C1A0E',
                    'dark-border': '#3D2314',
                    'dark-hover': '#5A3E28',
                    primary: '#7A5C3A',
                    muted: '#7A6050',
                    accent: '#A67C52',
                    sand: '#B8956E',
                    gold: '#C4A882',
                    border: '#D4C5A9',
                    card: '#EDE5D8',
                    bg: '#F7F3EC',
                    cream: '#FAF7F2',
                },
                'sinau-dark': '#2C1A0E',
                'sinau-dark-border': '#3D2314',
                'sinau-dark-hover': '#5A3E28',
                'sinau-primary': '#7A5C3A',
                'sinau-muted': '#7A6050',
                'sinau-accent': '#A67C52',
                'sinau-sand': '#B8956E',
                'sinau-gold': '#C4A882',
                'sinau-border': '#D4C5A9',
                'sinau-card': '#EDE5D8',
                'sinau-bg': '#F7F3EC',
                'sinau-cream': '#FAF7F2',
            },
        },
    },

    plugins: [forms],
};
