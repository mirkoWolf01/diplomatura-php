"use strict";

// ======================================================================
// CARGADOR DE PERSONAJE — API real (fetch)
// Mismo flujo que script-fetch.js, pero contra un servidor json-server
// de verdad (API de Rick and Morty) en vez de un server.php local.
// Diferencia clave: se usa .json() en vez de .text() — parsea la
// respuesta directo a objeto JS, sin JSON.parse() manual.
// ⚠️ Necesita json-server corriendo en el puerto 3001 (ver guía).
// ======================================================================

document.addEventListener("DOMContentLoaded", () => {
  const btnCargar = document.querySelector("#bttnLoad");
  const btnError = document.querySelector("#bttnError");
  const resultado = document.querySelector("#result");

  const URL_BASE = "https://rickandmortyapi.com/api/character"; // otro puerto = petición cross-origin (CORS)

  const hacerPeticion = (id) => {
    resultado.textContent = "Cargando...";

    fetch(`${URL_BASE}/${id}`)
      .then((respuesta) => {
        if (!respuesta.ok) {
          throw new Error(`Error ${respuesta.status}: ${respuesta.statusText}`);
        }
        return respuesta.json(); // parsea el body como JSON directo (reemplaza a .text() + JSON.parse)
      })
      .then((personaje) => {
        resultado.innerHTML = `
          <h2>${personaje.name}</h2>
          <img src="${personaje.image}" alt="${personaje.name}" width="150">
          <p>Estado: ${personaje.status}</p>
          <p>Especie: ${personaje.species}</p>
        `;
      })
      .catch((error) => {
        resultado.textContent = error.message;
      });
  };

  btnCargar.addEventListener("click", () => hacerPeticion(1));      // Rick Sanchez, existe
  btnError.addEventListener("click", () => hacerPeticion(99999));   // id que no existe -> 404 real
});