// Seleccionamos solo los links del NAV que llevan a una sección
const linksNav = document.querySelectorAll("nav a[href^='#'], .dropdown-menu a[href^='#']");

// Todas las secciones del main
const secciones = document.querySelectorAll(".seccion");

// Ocultar todas excepto #inicio al cargar
secciones.forEach(sec => {
  if (sec.id !== "inicio") sec.hidden = true;
});

// Cuando se hace click en un link del menú
linksNav.forEach(link => {
  link.addEventListener("click", () => {
    const destino = link.getAttribute("href");

    // Ocultar todas
    secciones.forEach(sec => sec.hidden = true);

    // Mostrar solo la elegida
    document.querySelector(destino).hidden = false;

    // Cerrar menú móvil si está abierto
    const navCollapse = document.getElementById('navbarScroll');
    if (navCollapse.classList.contains("show")) {
      new bootstrap.Collapse(navCollapse).hide();
    }
  });
});
