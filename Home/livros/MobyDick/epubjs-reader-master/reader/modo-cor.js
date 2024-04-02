function toggleMode() {
    const body = document.body;
    body.classList.toggle("dark-mode");
}

function setInitialMode() {
    // Verifica a preferência do usuário por modo escuro
    const prefersDarkMode = window.matchMedia("(prefers-color-scheme: dark)").matches;

    if (prefersDarkMode) {
        document.body.classList.add("dark-mode");
    }
}

setInitialMode();
