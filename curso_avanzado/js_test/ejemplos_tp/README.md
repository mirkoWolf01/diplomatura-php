# Ejemplo de trabajo practico: formulario de contacto

Este ejemplo resuelve la consigna del formulario de contacto en dos versiones:

- `xhr/`: utiliza `XMLHttpRequest`.
- `fetch/`: utiliza la API `fetch`.

Las dos versiones tienen el mismo HTML, validaciones y comportamiento. La unica diferencia importante esta en la forma de realizar la peticion AJAX.

Para preparar el entorno desde cero, consultar [INSTRUCTIVO.md](INSTRUCTIVO.md).

## Como probarlo

1. Copiar esta carpeta dentro de `htdocs`.
2. Iniciar Apache desde XAMPP.
3. Abrir una de estas direcciones:

   - `http://localhost/181843/8/ejemplos_tp/xhr/`
   - `http://localhost/181843/8/ejemplos_tp/fetch/`

No abrir los archivos con doble clic: el formulario necesita PHP para guardar la consulta.

No usar Live Server en el puerto `5500`: ese servidor solo entrega archivos estaticos y responde `405` cuando el formulario intenta hacer `POST` a PHP. Hay que abrir las direcciones anteriores con Apache de XAMPP.

## Que observar

- El formulario no recarga la pagina.
- Los campos marcados con `*` son obligatorios.
- Mientras se realiza la peticion aparece un estado de carga.
- La version `fetch` envia los datos a `fetch/guardar.php` y los guarda en `fetch/consultas.json`.
- La version `XMLHttpRequest` envia los datos a `xhr/guardar.php` y los agrega en `xhr/consultas.xml`.
- El boton de prueba de error solicita un archivo PHP inexistente.
- La pestaña Network del navegador permite ver la peticion AJAX.

## Propuesta para los alumnos

Modificar el formulario para agregar estilos, nuevos campos o una respuesta diferente. Luego comparar la implementacion con `XMLHttpRequest` y la implementacion con `fetch`.
