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
                error: 'var(--color-error)',
                default: 'var(--color-default)',
                "main-background": 'var(--color-main-background)',
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
            backgroundImage: {
              'gradient-primary': 'var(--gradient-primary)'
            },
            borderRadius: {
                'large': '10px',
            }
        },
    },
    plugins: [
        require('@tailwindcss/custom-forms'),
    ],
}