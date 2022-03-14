const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: [ 'Nunito', ...defaultTheme.fontFamily.sans ],
            },
            keyframes: {
                wiggle: {
                    '0%, 100%': {
                        transform: 'rotate(-3deg)'
                    },
                    '50%': {
                        transform: 'rotate(3deg)'
                    },
                },
                around: {
                    '0%': {
                        transform: 'rotate(0deg)'
                    },
                    '10%': {
                        transform: 'rotate(360deg)'
                    },
                    '20%': {
                        transform: 'rotate(0deg)'
                    },
                    '30%': {
                        transform: 'rotate(360deg)'
                    },
                    '40%': {
                        transform: 'rotate(0deg)'
                    },
                    '50%': {
                        transform: 'rotate(360deg)'
                    },
                    '60%': {
                        transform: 'rotate(0deg)'
                    },
                    '80%': {
                        transform: 'rotate(360deg)'
                    },
                    '90%': {
                        transform: 'rotate(0deg)'
                    },
                    '100%': {
                        transform: 'rotate(360deg)'
                    },
                },
            },
            animation: {
                wiggle: 'wiggle 1s ease-in-out infinite',
                around: 'around 3s  ease-in-out infinite',
            }
        },
        aspectRatio: {
            auto: 'auto',
            square: '1 / 1',
            video: '16 / 9',
            1: '1',
            2: '2',
            3: '3',
            4: '4',
            5: '5',
            6: '6',
            7: '7',
            8: '8',
            9: '9',
            10: '10',
            11: '11',
            12: '12',
            13: '13',
            14: '14',
            15: '15',
            16: '16',
        },
    },
    variants: {
        aspectRatio: [ 'responsive', 'hover' ]
    },
    plugins: [
        require('@tailwindcss/aspect-ratio'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography')
    ],
};
