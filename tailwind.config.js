const defaultTheme = require('tailwindcss/defaultTheme')
const plugin = require('tailwindcss/plugin')

module.exports = {
    purge: [],
    theme: {
        extend: {
            colors: {
                primary: 'var(--color-primary)',
                secondary: 'var(--color-secondary)',
                warning: 'var(--color-secondary)',
                info: 'var(--color-info)',
                success: 'var(--color-success)',
                danger: 'var(--color-danger)',

                "primary-darker": 'var(--color-primary-darker)',
                "primary-lighter": 'var(--color-primary-lighter)',
                "secondary-darker": 'var(--color-secondary-darker)',
                "secondary-lighter": 'var(--color-secondary-lighter)',
            },
            maxHeight: {
                '0': '0',
                xl: '36rem',
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            backgroundColor: {
                main: 'var(--bg-default)',
                primary: 'var(--color-primary)',
                secondary: 'var(--color-secondary)',
                warning: 'var(--color-secondary)',
                info: 'var(--color-info)',
                success: 'var(--color-success)',
                danger: 'var(--color-danger)',
            },
            backgroundImage: {
                'gradient-primary': 'var(--gradient-primary)'
            },
            background: {
                'main': 'var(--bg-default)'
            }
            ,
            borderRadius: {
                'large': '10px',
            }
        },
    },
    plugins: [
        require('@tailwindcss/custom-forms'),
    ],
}