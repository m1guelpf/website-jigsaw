let interval = setInterval(() => {
    if (document.querySelectorAll('.placeholder_button').length > 0) {
        document.querySelectorAll('.placeholder_button')[0].target = '_blank';
        clearInterval(interval)
    }
}, 1000)