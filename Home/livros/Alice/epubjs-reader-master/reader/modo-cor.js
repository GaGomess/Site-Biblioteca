function toggleMode() {
    const body = document.body;
    body.classList.toggle("light-mode");
}

function setInitialMode() {
    const prefersLightMode = window.matchMedia("(prefers-color-scheme: light)").matches;

    if (prefersLightMode) {
        document.body.classList.add("light-mode");
    }
}

setInitialMode();
