const setTheme = isLight => {
    if (isLight) {
        localStorage.setItem('theme', 'theme_light');
        document.body.classList.remove('global-hash-dark-version');
    } else {
        document.body.classList.add('global-hash-dark-version');
        localStorage.removeItem('theme');
    }
}

const toggleTheme = () => {
    const isLight = document.body.classList.contains('global-hash-dark-version');
    setTheme(isLight);
    document.body.dispatchEvent(
        new CustomEvent('theme-changed', {
            bubbles: true,
            detail: {
                isLight
            }
        }));
}

const syncThemeToggle = (slider, text) => {
    const isLight = !document.body.classList.contains('global-hash-dark-version');
    text.textContent = isLight ? 'Darken me' : 'Lighten Up';
    slider.checked = !isLight;
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

const initTheme = () => {
    const isLight = localStorage.getItem('theme') === 'theme_light';
    setTheme(isLight);
    initThemeToggle();
}

initTheme()