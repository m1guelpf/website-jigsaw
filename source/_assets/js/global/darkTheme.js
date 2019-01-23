const setTheme = isDark => {
    if (isDark) {
        localStorage.setItem('theme', 'theme_night');
        document.documentElement.classList.add('global-hash-dark-version');
    } else {
        document.documentElement.classList.remove('global-hash-dark-version');
        localStorage.removeItem('theme');
    }
}

const toggleTheme = () => {
    const isDark = !document.documentElement.classList.contains('global-hash-dark-version');
    setTheme(isDark);
    document.documentElement.dispatchEvent(
        new CustomEvent('theme-changed', {
            bubbles: true,
            detail: {
                isDark
            }
        }));
}

const syncThemeToggle = (slider, text) => {
    const isDark = document.documentElement.classList.contains('global-hash-dark-version');
    text.textContent = isDark ? 'Lighten Up' : 'Darken me';
    slider.checked = isDark;
}

const initThemeToggle = () => {
    const slider = document.getElementById('theme-slider');
    const text = document.getElementById('theme-text');
    syncThemeToggle(slider, text);
    slider.onclick = text.onclick = () => {
        toggleTheme();
        syncThemeToggle(slider, text);
    };
}

const contentLoaded = new Promise(resolve => {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => resolve());
    } else {
        resolve();
    }
});

const initTheme = () => {
    const isDark = localStorage.getItem('theme') === 'theme_night';
    setTheme(isDark);
    return contentLoaded.then(initThemeToggle);
}

initTheme().then(() => {
    document.body.classList.remove('loading')
})