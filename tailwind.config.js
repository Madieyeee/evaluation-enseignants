import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

const withOpacity = (variable) => ({ opacityValue }) => {
    if (opacityValue === undefined) {
        return `rgb(var(${variable}))`;
    }

    return `rgb(var(${variable}) / ${opacityValue})`;
};

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './resources/js/**/*.ts',
        './resources/js/**/*.tsx',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['"InterVariable"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                background: withOpacity('--color-bg'),
                foreground: withOpacity('--color-fg'),
                surface: withOpacity('--color-surface'),
                surfaceMuted: withOpacity('--color-surface-muted'),
                borderColor: withOpacity('--color-border'),
                accent: {
                    DEFAULT: withOpacity('--color-accent'),
                    soft: withOpacity('--color-accent-soft'),
                    foreground: withOpacity('--color-accent-foreground'),
                },
                danger: withOpacity('--color-danger'),
                success: withOpacity('--color-success'),
                muted: withOpacity('--color-muted'),
            },
            borderRadius: {
                lg: '0.75rem', // 12px
                xl: '1rem', // 16px
                '2xl': '1.25rem',
            },
            boxShadow: {
                subtle: '0 10px 30px -24px rgba(15, 23, 42, 0.45)',
            },
            transitionTimingFunction: {
                'soft-out': 'cubic-bezier(0.16, 1, 0.3, 1)',
            },
            container: {
                center: true,
                padding: '1.5rem',
                screens: {
                    '2xl': '1200px',
                },
            },
        },
    },
    plugins: [forms, typography],
};
