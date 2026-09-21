# Instructivo para iniciar y probar los ejemplos

Este material contiene dos versiones del mismo formulario:

- `xhr`: usa `XMLHttpRequest` y guarda las consultas en un archivo XML.
- `fetch`: usa `fetch` y guarda las consultas en un archivo JSON.

En ambos casos se necesita un servidor que pueda ejecutar PHP. No alcanza con abrir el HTML haciendo doble clic.

## 1. Ubicar el proyecto

La carpeta `ejemplos_tp` debe estar dentro de la carpeta publica del servidor web.

En XAMPP para Windows, la ubicacion habitual es:

```text
D:\xampp\htdocs\ejemplos_tp
```

En este curso la carpeta esta dentro de otro proyecto:

```text
D:\xampp\htdocs\181843\8\ejemplos_tp
```

La ruta puede ser diferente en cada computadora. Lo importante es identificar:

- la carpeta donde esta instalado XAMPP;
- la carpeta `htdocs`;
- el nombre de la carpeta del proyecto;
- la carpeta `ejemplos_tp`.

La estructura minima debe quedar asi:

```text
ejemplos_tp/
  INSTRUCTIVO.md
  README.md
  fetch/
    index.html
    script.js
    guardar.php
    consultas.json
  xhr/
    index.html
    script.js
    guardar.php
    consultas.xml
```

No es necesario cambiar las rutas escritas en los JavaScript. Son rutas relativas y funcionan mientras se conserve esta estructura.

## 2. Opcion recomendada: XAMPP y Apache

1. Abrir el panel de control de XAMPP.
2. Iniciar el modulo **Apache**.
3. Confirmar que Apache figure como activo.
4. Abrir el navegador.
5. Escribir la URL que corresponda a la ubicacion de la carpeta.

Si la carpeta esta en:

```text
D:\xampp\htdocs\181843\8\ejemplos_tp
```

las direcciones son:

```text
http://localhost/181843/8/ejemplos_tp/fetch/
http://localhost/181843/8/ejemplos_tp/xhr/
```

Si la carpeta esta directamente en `htdocs`:

```text
D:\xampp\htdocs\ejemplos_tp
```

las direcciones son:

```text
http://localhost/ejemplos_tp/fetch/
http://localhost/ejemplos_tp/xhr/
```

### Si Apache usa otro puerto

Si Apache fue configurado en el puerto `8080`, hay que incluirlo en la URL:

```text
http://localhost:8080/181843/8/ejemplos_tp/fetch/
```

El puerto se puede consultar en el panel de XAMPP o en la configuracion de Apache.

## 3. Opcion alternativa: servidor incorporado de PHP

Esta opcion sirve si no se usa XAMPP, pero PHP debe estar instalado y disponible desde la terminal.

1. Abrir una terminal.
2. Entrar en la carpeta `ejemplos_tp`.
3. Iniciar el servidor:

```text
cd D:\xampp\htdocs\181843\8\ejemplos_tp
php -S localhost:8000
```

4. Abrir estas direcciones:

```text
http://localhost:8000/fetch/
http://localhost:8000/xhr/
```

Para detener el servidor, volver a la terminal y presionar `Ctrl + C`.

En Windows, si `php` no es reconocido, se puede usar la ruta completa de PHP de XAMPP:

```text
D:\xampp\php\php.exe -S localhost:8000 -t D:\xampp\htdocs\181843\8\ejemplos_tp
```

## 4. Probar la version fetch

1. Abrir la carpeta `fetch` desde la URL del servidor.
2. Completar los campos obligatorios.
3. Presionar **Enviar consulta**.
4. Verificar el mensaje de confirmacion.
5. Abrir el archivo `fetch/consultas.json` y comprobar que se agrego la consulta.

La peticion se realiza de esta manera:

```text
fetch/guardar.php -> fetch/consultas.json
```

## 5. Probar la version XMLHttpRequest

1. Abrir la carpeta `xhr` desde la URL del servidor.
2. Completar los campos obligatorios.
3. Presionar **Enviar consulta**.
4. Verificar el mensaje de confirmacion.
5. Abrir el archivo `xhr/consultas.xml` y comprobar que se agrego un nuevo elemento `<consulta>`.

La peticion se realiza de esta manera:

```text
xhr/guardar.php -> xhr/consultas.xml
```

## 6. Probar la validacion

Intentar enviar el formulario sin completar los campos marcados con `*`.

El formulario debe:

- impedir el envio;
- indicar que faltan campos obligatorios;
- enfocar el primer campo invalido.

## 7. Revisar la peticion AJAX

En el navegador:

1. Presionar `F12`.
2. Abrir la pestaña **Network** o **Red**.
3. Enviar una consulta.
4. Buscar `guardar.php`.
5. Revisar que el metodo sea `POST`.
6. Revisar la respuesta del servidor.

## 8. Errores frecuentes

### Error 404

La URL no coincide con la ubicacion de la carpeta o Apache no encuentra el archivo.

Revisar:

- el nombre de la carpeta del proyecto;
- que `ejemplos_tp` este dentro de `htdocs`;
- que Apache este iniciado;
- que la URL no tenga carpetas de mas o de menos.

### Error 405

La pagina fue abierta con Live Server, normalmente en el puerto `5500`. Live Server entrega HTML, CSS y JavaScript, pero no ejecuta PHP ni acepta este `POST`.

Usar Apache de XAMPP o el servidor incorporado de PHP.

### Error 422

El servidor recibio la peticion, pero faltan datos obligatorios o el email no tiene un formato valido.

Completar nuevamente el formulario y revisar los campos requeridos.

### No se puede guardar el archivo

PHP no tiene permisos para escribir en `consultas.json` o `consultas.xml`.

En Windows, revisar los permisos de la carpeta `fetch` o `xhr`. Tambien se puede verificar que los archivos existan y no esten abiertos por otro programa.

### La pagina se abre pero no guarda

No abrir el archivo con una ruta como esta:

```text
file:///D:/xampp/htdocs/181843/8/ejemplos_tp/fetch/index.html
```

Debe abrirse mediante una URL HTTP, por ejemplo:

```text
http://localhost/181843/8/ejemplos_tp/fetch/
```

## 9. Diferencia entre las dos versiones

El formulario y la informacion enviada son iguales. Cambia la herramienta usada para realizar la peticion:

- `fetch` trabaja con promesas y convierte la respuesta con `response.json()`.
- `XMLHttpRequest` trabaja con estados de la peticion y recibe una respuesta XML.

La idea es resolver el mismo problema con dos APIs diferentes y comparar sus pasos.
