"use strict";

document.addEventListener("DOMContentLoaded", () => {
  const formulario = document.querySelector("#formularioContacto");
  const btnError = document.querySelector("#btnError");
  const resultado = document.querySelector("#resultado");

  const validarFormulario = () => {
    if (formulario.checkValidity()) {
      return true;
    }

    resultado.textContent = "Completá correctamente los campos obligatorios.";
    formulario.querySelector(":invalid").focus();
    return false;
  };

  const guardarConsulta = (url) => {
    resultado.textContent = "Enviando...";

    const peticion = new XMLHttpRequest();

    peticion.onreadystatechange = () => {
      if (peticion.readyState !== XMLHttpRequest.DONE) {
        return;
      }

      if (peticion.status >= 200 && peticion.status < 300) {
        const documento = new DOMParser().parseFromString(peticion.responseText, "application/xml");
        const titulo = documento.querySelector("titulo").textContent;
        const mensaje = documento.querySelector("mensaje").textContent;
        resultado.textContent = `${titulo}: ${mensaje}`;
      } else {
        resultado.textContent = `No se pudo guardar la consulta. Error ${peticion.status}.`;
      }
    };

    peticion.onerror = () => {
      resultado.textContent = "Ocurrio un error de red.";
    };

    peticion.open("POST", url, true);
    peticion.send(new FormData(formulario));
  };

  formulario.addEventListener("submit", (evento) => {
    evento.preventDefault();

    if (validarFormulario()) {
      guardarConsulta("guardar.php");
    }
  });

  btnError.addEventListener("click", () => guardarConsulta("no-existe.php"));
});
