import './bootstrap';

import Alpine from 'alpinejs';
import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);

window.Alpine = Alpine;

// Configuration globale Chart.js avec support dark mode
window.getChartTheme = () => {
    const isDark = document.documentElement.classList.contains('dark');

    return {
        colors: {
            primary: isDark ? 'rgb(129, 140, 248)' : 'rgb(79, 70, 229)',
            primarySoft: isDark ? 'rgba(129, 140, 248, 0.2)' : 'rgba(79, 70, 229, 0.2)',
            success: isDark ? 'rgb(45, 212, 191)' : 'rgb(16, 185, 129)',
            danger: isDark ? 'rgb(248, 113, 113)' : 'rgb(239, 68, 68)',
            warning: isDark ? 'rgb(251, 191, 36)' : 'rgb(245, 158, 11)',
            muted: isDark ? 'rgb(148, 163, 184)' : 'rgb(100, 116, 139)',
            border: isDark ? 'rgb(30, 41, 59)' : 'rgb(226, 232, 240)',
            background: isDark ? 'rgb(15, 23, 42)' : 'rgb(255, 255, 255)',
        },
        fonts: {
            family: '"InterVariable", system-ui, -apple-system, sans-serif',
            size: 12,
            color: isDark ? 'rgb(226, 232, 240)' : 'rgb(15, 23, 42)',
        },
        grid: {
            color: isDark ? 'rgba(30, 41, 59, 0.6)' : 'rgba(226, 232, 240, 0.8)',
        },
    };
};

// Appliquer la config par défaut à tous les charts
window.createChart = (ctx, config) => {
    const theme = window.getChartTheme();

    const defaults = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                labels: {
                    font: theme.fonts,
                    usePointStyle: true,
                    pointStyle: 'circle',
                },
            },
            tooltip: {
                backgroundColor: theme.colors.background,
                titleColor: theme.fonts.color,
                bodyColor: theme.colors.muted,
                borderColor: theme.colors.border,
                borderWidth: 1,
                cornerRadius: 8,
                padding: 12,
                titleFont: { ...theme.fonts, weight: '600' },
                bodyFont: theme.fonts,
            },
        },
        scales: {
            x: {
                grid: { color: theme.grid.color },
                ticks: { color: theme.colors.muted, font: theme.fonts },
            },
            y: {
                grid: { color: theme.grid.color },
                ticks: { color: theme.colors.muted, font: theme.fonts },
            },
        },
    };

    // Fusionner la config utilisateur avec les defaults
    const mergedConfig = {
        ...config,
        options: {
            ...defaults,
            ...config.options,
            plugins: { ...defaults.plugins, ...config.options?.plugins },
            scales: config.options?.scales !== false ? { ...defaults.scales, ...config.options?.scales } : false,
        },
    };

    return new Chart(ctx, mergedConfig);
};

window.themeSwitcher = () => ({
    isDark: false,
    init() {
        const stored = window.localStorage.getItem('theme');
        if (stored === 'dark') {
            this.isDark = true;
            return;
        }

        if (!stored && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            this.isDark = true;
        }
    },
    toggle() {
        this.isDark = !this.isDark;
        window.localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
    },
});

Alpine.start();
