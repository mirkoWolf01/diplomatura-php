// ======================================================================
// AGENDA DE CONTACTOS CON ES6
// Reúne, en un solo proyecto, la sintaxis nueva de la clase: template
// strings, let/const, arrow functions, destructuring, valores por
// defecto, spread y rest. Reutiliza querySelector, DOMContentLoaded y
// el evento "input" de la clase anterior (DOM).
// ======================================================================

document.addEventListener("DOMContentLoaded", () => {
  console.log("DOM listo");

  // ============ Datos ============
  // "let" y no "const": más adelante REEMPLAZAMOS este array entero
  // con Spread (agregarContacto), y eso es reasignar la variable.
  let contactos = [
    { nombre: "Ana", telefono: "11-2222-3333", email: "ana@mail.com" },
    { nombre: "Luis", telefono: "11-4444-5555", email: "luis@mail.com" },
    { nombre: "Marta", telefono: "11-6666-7777", email: "marta@mail.com" },
  ];

  // ============ Selectores ============
  const buscador = document.querySelector("#buscador");
  const listaContactos = document.querySelector("#listaContactos");
  const nuevoNombre = document.querySelector("#nuevoNombre");
  const nuevoTelefono = document.querySelector("#nuevoTelefono");
  const nuevoEmail = document.querySelector("#nuevoEmail");
  const btnAgregar = document.querySelector("#btnAgregar");


  // ============ Render: arrow function + destructuring + template string ============
  const renderContactos = (lista) => {
    listaContactos.innerHTML = lista.map((contacto) => {
      // Destructuracion de objetos
      const { nombre, telefono, email } = contacto
      // const nombre = contacto.nombre
      // const telefono = contacto.telefono
      // const email = contacto.email

      return `
        <div class="contacto">
          <strong> ${nombre} </strong> <br>
          📞 ${telefono} <br>
          📩 ${email}
        </div>
      `
    }).join("") // .map devuelve un array de string, join los une en uno solo, basicamente quita la coma del array
    };

    renderContactos(contactos)

  // ============ Buscador en vivo: filter + arrow function ============
   buscador.addEventListener("input", () => {
    const texto = buscador.value.toLowerCase();

    const filtrados = contactos.filter((contacto) =>
      contacto.nombre.toLowerCase().includes(texto)
    );

    renderContactos(filtrados);
  });



  // ============ Agregar contacto: spread + valor por defecto ============
  const agregarContacto = (nombre, telefono, email = "Sin email") => {
    // shorthand property names, si la variable se llama igual que la key
    // no hace falta escribir nombre: nombre
    const nuevoContacto = {nombre, telefono, email}

    // spread operator
    contactos = [...contactos, nuevoContacto]

    renderContactos(contactos)
  };

  btnAgregar.addEventListener("click", () => {
    // tomamos los tres datos del form, sus valores y los trimeamos
    // " fabricio ".trim() => "fabricio" // Evita que nos manden espacios como valor
    const nombre = nuevoNombre.value.trim()
    const telefono = nuevoTelefono.value.trim()
    const email = nuevoEmail.value.trim()

    // validacion por si no me mandan ni nombre ni telefono
    if(nombre === "" || telefono === ""){
      return
    }

    if(email === ""){
      agregarContacto(nombre, telefono)
    } else {
      agregarContacto(nombre, telefono, email)
    }

    // limpieza de los inputs del form luego de haber creado el dato nuevo
    nuevoNombre.value = ""
    nuevoNombre.value = ""
    nuevoEmail.value = ""
  });


  // ============ Extra: Rest — juntar varias listas en un solo total ============
  // Los tres puntos en un PARÁMETRO de función juntan lo que llega en un
  // array. Es lo contrario de Spread (que DESARMA un array existente).
  const contarContactos = (...listas) =>
    listas.reduce((total, lista) => total + lista.length, 0);

  console.log("Contactos totales (demo de Rest):", contarContactos(contactos));
});
