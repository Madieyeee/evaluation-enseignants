import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

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
