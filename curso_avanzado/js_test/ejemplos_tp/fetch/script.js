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

  const guardarConsulta = (url, opciones = {}) => {
    resultado.textContent = "Enviando...";

    fetch(url, opciones)
      .then((respuesta) => {
        if (!respuesta.ok) {
          if (respuesta.status === 405) {
            throw new Error("El servidor no acepta POST. Abrí este ejemplo desde Apache/XAMPP, no desde Live Server (puerto 5500).");
          }

          throw new Error(`Error ${respuesta.status}: ${respuesta.statusText}`);
        }

        return respuesta.json();
      })
      .then((respuesta) => {
        resultado.textContent = `${respuesta.titulo}: ${respuesta.mensaje}`;
      })
      .catch((error) => {
        resultado.textContent = `No se pudo guardar la consulta. ${error.message}`;
      });
  };

  formulario.addEventListener("submit", (evento) => {
    evento.preventDefault();

    if (validarFormulario()) {
      guardarConsulta("guardar.php", {
        method: "POST",
        body: new FormData(formulario)
      });
    }
  });

  btnError.addEventListener("click", () => guardarConsulta("no-existe.php"));
});
