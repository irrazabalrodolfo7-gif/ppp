// =============================================================
//  MODO OSCURO / MODO CLARO - EXPLICADO PASO A PASO
// =============================================================
//  Este archivo controla el sistema de "modo oscuro / modo claro".
//  Usa dos cosas:
//      1) classList.toggle() para agregar o quitar una clase del <body>
//      2) localStorage para recordar el modo elegido aunque cierres la página
// =============================================================

// -------------------------------------------------------------
// FUNCION: cambiarModo()
// -------------------------------------------------------------
// Esta función se ejecuta cuando el usuario toca el botón de modo.
// Lo que hace es alternar (toggle) la clase "claro" del <body>.
// Si la clase existe → se quita.
// Si no existe → se agrega.
// Esa clase es la que define los colores del modo claro.
// -------------------------------------------------------------
function cambiarModo() {

    // Alterna la clase "claro" dentro del elemento <body>.
    // Si no estaba → se agrega.
    // Si estaba → se elimina.
    document.body.classList.toggle('claro');

    // ---------------------------------------------------------
    //  GUARDAR EL MODO ELEGIDO EN localStorage
    // ---------------------------------------------------------
    //  Esto permite que si el usuario recarga la página, el modo
    //  siga siendo el mismo.
    //
    //  localStorage funciona como una "caja" que guarda pares
    //  de clave:valor. En este caso clave = "modo".
    // ---------------------------------------------------------
    if (document.body.classList.contains('claro')) {
        // Si la clase existe, entonces estamos en modo CLARO
        localStorage.setItem('modo', 'claro');
    } else {
        // Si la clase fue quitada, estamos en modo OSCURO
        localStorage.setItem('modo', 'oscuro');
    }
}

// -------------------------------------------------------------
// MANTENER EL MODO AL RECARGAR LA PÁGINA
// -------------------------------------------------------------
// Cuando la página termina de cargar (DOMContentLoaded),
// revisamos lo que guardamos en localStorage.
// Si dice "claro", entonces volvemos a agregar la clase.
// Si dice otra cosa o no existe, dejamos el modo oscuro por defecto.
// -------------------------------------------------------------
document.addEventListener("DOMContentLoaded", () => {

    // Recuperamos el valor guardado.
    const modoGuardado = localStorage.getItem('modo');

    // Si el valor encontrado es "claro", entonces aplicamos ese modo.
    if (modoGuardado === 'claro') {
        document.body.classList.add('claro');
    }
});