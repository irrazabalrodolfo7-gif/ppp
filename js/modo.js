// === MODO OSCURO / CLARO ===
// Esta función alterna entre los modos agregando o quitando
// la clase .claro del <body>.
function cambiarModo() {
    document.body.classList.toggle('claro');

    // Guarda el modo elegido en localStorage
    if (document.body.classList.contains('claro')) {
        localStorage.setItem('modo', 'claro');
    } else {
        localStorage.setItem('modo', 'oscuro');
    }
}

// === Mantener modo al recargar la página ===
// Esto lee localStorage y aplica el modo guardado.
document.addEventListener("DOMContentLoaded", () => {
    const modoGuardado = localStorage.getItem('modo');
    if (modoGuardado === 'claro') {
        document.body.classList.add('claro');
    }
});
