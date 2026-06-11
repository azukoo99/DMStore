import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Theme toggle logic (run early to prevent flashing)
const getThemeFromCookie = () => {
    const cookies = document.cookie.split('; ');
    const themeCookie = cookies.find(row => row.startsWith('color-theme='));
    return themeCookie ? themeCookie.split('=')[1] : null;
};

const setThemeCookie = (value) => {
    const date = new Date();
    date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000));
    document.cookie = `color-theme=${value}; expires=${date.toUTCString()}; path=/; SameSite=Lax`;
};

const initTheme = () => {
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const lightIcon = document.getElementById('theme-toggle-light-icon');

    const theme = getThemeFromCookie();
    const isDark = theme === 'dark' || 
                   (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches);

    if (isDark) {
        document.documentElement.classList.add('dark');
        if (lightIcon) lightIcon.classList.remove('hidden');
        if (darkIcon) darkIcon.classList.add('hidden');
    } else {
        document.documentElement.classList.remove('dark');
        if (darkIcon) darkIcon.classList.remove('hidden');
        if (lightIcon) lightIcon.classList.add('hidden');
    }
};

// Custom JS logic for DiamondStore
document.addEventListener('DOMContentLoaded', () => {
    initTheme();

    const themeToggleBtn = document.getElementById('theme-toggle');
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const lightIcon = document.getElementById('theme-toggle-light-icon');

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                setThemeCookie('light');
                if (darkIcon) darkIcon.classList.remove('hidden');
                if (lightIcon) lightIcon.classList.add('hidden');
            } else {
                document.documentElement.classList.add('dark');
                setThemeCookie('dark');
                if (lightIcon) lightIcon.classList.remove('hidden');
                if (darkIcon) darkIcon.classList.add('hidden');
            }
        });
    }

    const hamburger = document.getElementById('hamburger');
    const menu = document.getElementById('navbar-menu');

    if (hamburger && menu) {
        hamburger.addEventListener('click', function () {
            menu.classList.toggle('menu-open');
            hamburger.classList.toggle('active');
        });

        document.querySelectorAll('.nav-link').forEach(function (link) {
            link.addEventListener('click', function () {
                menu.classList.remove('menu-open');
                hamburger.classList.remove('active');
            });
        });
    }
});
